<?php

namespace App\Services;

use App\Models\ZohoOAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ZohoOAuthService
{
    public const ZOHO_ACCOUNT_URL = 'https://accounts.zoho.eu/oauth/v2/token';

    private string $clientId;
    private string $clientSecret;
    private string $clientCode;
    private string $redirectUri;

    public function __construct()
    {
        $this->clientId = env('ZOHO_CLIENT_ID');
        $this->clientSecret = env('ZOHO_CLIENT_SECRET');
        $this->clientCode = env('ZOHO_CLIENT_CODE');
        $this->redirectUri = env('APP_URL');
    }

    public function getGenerateRequestBody(): array
    {
        return array_merge($this->getBaseRequestBody(), [
            'code' => $this->clientCode,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);
    }

    public function getRefreshRequestBody(): array
    {
        return array_merge($this->getBaseRequestBody(), [
            'refresh_token' => $this->getRefreshToken(),
            'grant_type' => 'refresh_token',
        ]);
    }

    public function getBaseRequestBody(): array
    {
        return [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    /**
     * @throws \Exception
     */
    public function makeRequest(array $requestBody)
    {
        $response = Http::asForm()->post(self::ZOHO_ACCOUNT_URL, $requestBody);

        if (!$response->successful()) {
            throw new \Exception('Unexpected error. Please try again later.');
        }

        return json_decode($response->body(), true);
    }

    public function prepareData($responseData): array
    {
        return [
            'access_token' => $responseData['access_token'],
            'refresh_token' => $responseData['refresh_token'] ?? $this->getRefreshToken(),
            'api_domain' => $responseData['api_domain'],
            'expires_at' => Carbon::now()->addSeconds($responseData['expires_in']),
        ];
    }

    public function saveToDb(array $preparedData): void
    {
        ZohoOAuth::createOrUpdate($preparedData);
    }

    public function getRefreshToken(): ?string
    {
        return ZohoOAuth::getRefreshToken();
    }
}
