<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $fbid = Auth::user()->fbid;
        $id = Auth::user()->id;
        $campaigns = DB::table('campaigns')->where([
            ['account_id', '=', $fbid],
            ['user_id', '=', $id]
            ])->paginate(5);
        return view('home', compact('campaigns', 'fbid'));
    }

    public function adset($campaign_id)
    {   
        $id = Auth::user()->id;
        $url = url()->current();
        $adsets = DB::table('adsets')->where([
            ['campaign_id', '=', $campaign_id],
            ['user_id', '=', $id]
            ])->paginate(5);
        return view('adset', ['adsets' => $adsets, 'url' => $url]);
    }

    public function ads($campaign_id, $adset_id)
    {   
        
        $fbid = Auth::user()->fbid;
        $url = request()->fullUrl();
        $ads = Cache::rememberForever('ads' . $fbid . $url, function() use ($campaign_id, $adset_id) {
            $id = Auth::user()->id;
            return DB::table('ads')->where([
                ['adset_id', '=', $adset_id],
                ['user_id', '=', $id]
                ])->paginate(5);
        });
        return view('ads', compact('ads', 'campaign_id', 'adset_id'));
    }

    public function update_id()
    {   
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        $user->fbid = request('fbid');
        $user->update();
        return redirect('home');
    }
}