<?php

namespace App\Libraries\Recaptcha;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class RecaptchaApiClient
{
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.recaptcha.url'),
            'timeout' => 5
        ]);
    }

    public function verify($token) : array
    {
        $result = '{}';

        try {
            $response = $this->client->request('POST', 'siteverify', [
                'multipart' => [
                    [
                        'name' => 'secret',
                        'contents' => config('services.recaptcha.secret_key')
                    ],
                    [
                        'name' => 'response',
                        'contents' => $token
                    ],
                ]
            ]);

            $result = $response->getBody()->getContents();
        } catch (RequestException $e) {
            if ($e->getCode() >= 500) {
                throw $e;
            }

            logger()->info($e->getMessage());

            return ["error" => "timeout"];
        }

        return json_decode($result, true);
    }
}
