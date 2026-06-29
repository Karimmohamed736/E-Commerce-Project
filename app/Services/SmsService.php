<?php

namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Messages\Channel\SMS\SMSText;
use GuzzleHttp\Client as GuzzleClient;
use Exception;

class SmsService
{
    protected Client $client;

    public function __construct()
    {
        $basic = new Basic(
            config('services.vonage.key'),
            config('services.vonage.secret')
        );

        $httpClient   = new GuzzleClient(['verify' => false]);
        $this->client = new Client($basic, [], $httpClient);
    }

    public function send(string $to, string $message): array
    {
        try {
            $sms = new SMSText($to, "Vonage APIs", $message);
            $this->client->messages()->send($sms);

            return ['success' => true, 'message' => 'SMS sent successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
