<?php

namespace App\Services;

use GuzzleHttp\Client;

class EmailVerificationService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('ABSTRACT_API_KEY');
    }

    public function verify($email)
    {
        try {
            $response = $this->client->get('https://emailvalidation.abstractapi.com/v1/', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'email' => $email,
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            return [
                'is_valid' => $result['deliverability'] === 'DELIVERABLE',
                'quality_score' => $result['quality_score'] ?? 0,
                'is_free_email' => $result['is_free_email'] ?? false,
                'is_disposable' => $result['is_disposable_email'] ?? false,
            ];
        } catch (\Exception $e) {
            return ['is_valid' => false];
        }
    }
}
