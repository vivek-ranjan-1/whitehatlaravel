<?php

namespace App\Services;

use GuzzleHttp\Client;

class VonageService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $from;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.vonage.api_key');
        $this->apiSecret = config('services.vonage.api_secret');
        $this->from = config('services.vonage.from');
    }

    public function sendSms($to, $text)
    {
        try {
            $response = $this->client->request('POST', 'https://rest.nexmo.com/sms/json', [
                'form_params' => [
                    'api_key' => $this->apiKey,
                    'api_secret' => $this->apiSecret,
                    'to' => $to,
                    'from' => $this->from,
                    'text' => $text
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            // Handle exceptions here
            return $e->getMessage();
        }
    }
}
