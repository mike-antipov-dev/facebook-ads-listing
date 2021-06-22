<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use FacebookAds\Api;
use FacebookAds\Facebook;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\AdFields;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\MarketingApi;

class FB extends Controller
{
      
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
      public function redirect()
      {
        if (!Auth::check()) {
          return redirect('login');
        }
        
        return Socialite::driver('facebook')->redirect();
      }
      /**
       * Return a callback method from facebook api.
       *
       * @return callback URL from facebook
       */
      public function callback()
      {
        if (!Auth::check()) {
          return redirect('login');
        }
        
        $fbid = Auth::user()->fbid; // Personal Account ID
        $id = Auth::user()->id; // Laravel user ID
        try {
          $user = Socialite::driver('facebook')->stateless()->user(); // FB user data
        } catch (\Exception $e) {
          return 'Error: ' . response()->json([
              'message' => $e->getMessage()
          ]);
        }
        $accessToken = $user->token;
        $app_id = env('FB_ADS_APP_ID');
        $app_secret = env('FB_ADS_APP_SECRET');
        $access_token = $accessToken;
        $account_id = "act_" . $fbid;

        Api::init($app_id, $app_secret, $access_token); // Initializing FB Marketing API

        /* API fields to fetch */
        $campaignFields = array(
          'id',
          'account_id',
          'name'
        );

        $adsetFields = array(
          'id',
          'account_id',
          'campaign_id',
          'name'
        );

        $adFields = array(
          'id',
          'account_id',
          'campaign_id',
          'adset_id',
          'name'
        );

        $account = new AdAccount($account_id); // Getting campaigns, adsets and ads data
        $res = new MarketingApi; // Getting their stats
        
        DB::table('campaigns')->where([
          ['account_id', '=', $fbid],
          ['user_id', '=', $id]
          ])->truncate();
        DB::table('adsets')->where([
          ['account_id', '=', $fbid],
          ['user_id', '=', $id]
          ])->truncate();
        DB::table('ads')->where([
          ['account_id', '=', $fbid],
          ['user_id', '=', $id]
          ])->truncate();

        try {
          $campaignsList = $account->getCampaigns($campaignFields)->getResponse()->getContent();
        } catch (\Exception $e) {
          return 'Error: ' . response()->json([
              'message' => $e->getMessage()
          ]);
        }
        
        foreach ($campaignsList['data'] as $campaign) {
          $response = $res->getIns($campaign['id'],$accessToken);
          DB::table('campaigns')->insert(
            ['id' => $campaign['id'],
            'user_id' => $id,
            'account_id' => $campaign['account_id'],
            'name' => $campaign['name'],
            'buying_type' => $response['data'][0]['buying_type'],
            'action_values' => $response['data'][0]['action_values'],
            'clicks' => $response['data'][0]['clicks'],
            'conversion_values' => $response['data'][0]['conversion_values'],
            ]
          );
        }
        
        $adsetsList = $account->getAdSets($adsetFields)->getResponse()->getContent();  
        foreach ($adsetsList['data'] as $adset) {
          $response = $res->getIns($adset['id'],$accessToken);
          DB::table('adsets')->insert(
            ['id' => $adset['id'],
            'user_id' => $id,
            'account_id' => $adset['account_id'],
            'campaign_id' => $adset['campaign_id'],
            'name' => $adset['name'],
            'action_values' => $response['data'][0]['action_values'],
            'clicks' => $response['data'][0]['clicks'],
            'conversion_values' => $response['data'][0]['conversion_values']]
          );
        }

        $adsList = $account->getAds($adFields)->getResponse()->getContent();
        foreach ($adsList['data'] as $ad) {
          $response = $res->getIns($ad['id'],$accessToken);
          DB::table('ads')->insert(
            ['id' => $ad['id'],
            'user_id' => $id,
            'account_id' => $ad['account_id'],
            'campaign_id' => $ad['campaign_id'],
            'adset_id' => $ad['adset_id'],
            'name' => $ad['name'],
            'action_values' => $response['data'][0]['action_values'],
            'clicks' => $response['data'][0]['clicks'],
            'conversion_values' => $response['data'][0]['conversion_values']]
          );
        }

        return redirect('home');
      }
  }