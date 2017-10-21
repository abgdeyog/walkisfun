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
        $params = ['count' => 200, 'extended' => 1];

        $items = $this->api('users.getSubscriptions', $params);

        $subs = [];
        foreach ($items as $item) {
            if (isset($item->gid)) $subs[] = $item->gid;
        }
        return $subs;
    }

    private function api($methodName, $params)
    {
        $params['access_token'] = $this->accessToken;

        $paramArray = [];
        foreach ($params as $key => $param) {
            $paramArray[] = $key . '=' . $param;
        }
        $url = "https://api.vk.com/method/{$methodName}?" . implode('&', $paramArray);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($output);

        return $result->response;
    }
}