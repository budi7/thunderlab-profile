<?php
namespace App\Http\Traits;

use GuzzleHttp\Client;

trait recaptchaTrait {
    public static function validateCaptcha($token = null) {
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);

        $response = $client->post('siteverify', [
            'query' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $token,
                'verify' => false
            ]
        ]);

        return json_decode($response->getBody())->success;
    }
}