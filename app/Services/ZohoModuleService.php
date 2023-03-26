<?php

namespace App\Services;

use App\Models\ZohoOAuth;
use Illuminate\Support\Facades\Http;

class ZohoModuleService
{
    public const END_POINT = '/crm/v4/';
    public const CONTACTS_MODULE = 'Contacts';
    public const DEALS_MODULE = 'Deals';
    private string $apiDomain;
    private string $accessToken;

    public function __construct()
    {
        $this->apiDomain = ZohoOAuth::getApiDomain();
        $this->accessToken = ZohoOAuth::getAccessToken();
    }

    public function getContactsRequestUrl(): string
    {
        return $this->getBaseRequestUrl() . self::CONTACTS_MODULE;
    }

    public function getDealsRequestUrl(): string
    {
        return $this->getBaseRequestUrl() . self::DEALS_MODULE;
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
