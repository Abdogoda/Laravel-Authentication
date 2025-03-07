<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PhoneVerificationService
{
    protected $accessToken;
    protected $phoneId;
    protected $templateName;
    protected $apiVersion = 'v22.0';

    public function __construct()
    {
        $this->accessToken   = config('services.whatsapp.access_token');
        $this->phoneId       = config('services.whatsapp.phone_id');
        $this->templateName  = config('services.whatsapp.template_name');
    }

    /**
     * Send an OTP template message via WhatsApp.
     *
     * @param  string  $recipientPhone
     * @param  string  $otp
     * @return \Illuminate\Http\Client\Response
     */
    public function sendOtpMessage($recipientPhone, $otp)
    {
        $url = "https://graph.facebook.com/{$this->apiVersion}/{$this->phoneId}/messages";

        $payload = [
            "messaging_product" => "whatsapp",
            "to"                => $recipientPhone,
            "type"              => "template",
            "template"          => [
                "name"     => $this->templateName,
                "language" => [
                    "code" => "en_US"
                ],
                "components" => [
                    [
                        "type"       => "body",
                        "parameters" => [
                            [
                                "type" => "text",
                                "text" => $otp
                            ]
                        ]
                    ],
                    [
                        "type"       => "button",
                        "sub_type"   => "url",
                        "index"      => 0,
                        "parameters" => [
                            [
                                "type" => "text",
                                "text" => $otp
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
            'Content-Type'  => 'application/json',
        ])->post($url, $payload);
        return $response;

    }
}
