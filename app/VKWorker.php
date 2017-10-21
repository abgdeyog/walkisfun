<?php

namespace App;

class VKWorker
{
    private $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function usersGetSubscriptions()
    {
        $params = ['count' => 200];

        return $this->api('users.getSubscriptions', $params)->groups->items;
    }

    private function api($methodName, $params)
    {
        $params['access_token'] = $this->accessToken;
        $url = "https://api.vk.com/method/$methodName" . implode('&', $params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output)->response;
    }
}