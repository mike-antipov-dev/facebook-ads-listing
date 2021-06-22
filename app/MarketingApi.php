<?php

namespace App;

use FacebookAds\Api;
use FacebookAds\Facebook;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\AdFields;

class MarketingApi
{
    public function getIns ($insId, $accessToken) {
        $client = new \GuzzleHttp\Client();
        $insFields = 'action_values,clicks,conversion_values';
    
        $response = json_decode ($client->request('GET', 'https://graph.facebook.com/v5.0/' . $insId . '/insights?fields=buying_type,' . $insFields . '&date_preset=lifetime' . '&access_token=' . $accessToken)->getBody(), true);

        if (empty($response['data'][0]['action_values'])) {
        $response['data'][0]['action_values'] = 'n/a';
        }
        if (empty($response['data'][0]['buying_type'])) {
        $response['data'][0]['buying_type'] = 'n/a';
        }
        if (empty($response['data'][0]['conversion_values'])) {
        $response['data'][0]['conversion_values'] = 'n/a';
        }

        return $response;
    }
}
