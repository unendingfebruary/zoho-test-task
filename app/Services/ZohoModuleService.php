<?php

namespace App\Services;

use App\Models\ZohoOAuth;
use Illuminate\Support\Facades\Http;

class ZohoModuleService
{
    public const END_POINT = '/crm/v4/';

    private string $apiDomain;
    private string $accessToken;

    public function __construct()
    {
        $this->apiDomain = ZohoOAuth::getApiDomain();
        $this->accessToken = ZohoOAuth::getAccessToken();
    }

    public function getRequestUrl(string $module): string
    {
        return $this->getBaseRequestUrl() . $module;
    }

    public function getBaseRequestUrl(): string
    {
        return $this->apiDomain . self::END_POINT;
    }

    public function getRequestBody(array $requestData): array
    {
        return [
            'data' => [
                $requestData,
            ]
        ];
    }

    public function makeRequest(string $requestUrl, array $requestBody)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $this->accessToken
        ])->post($requestUrl, $requestBody);

        return json_decode($response->body(), true);
    }
}
