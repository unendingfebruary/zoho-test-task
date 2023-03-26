<?php

namespace App\Http\Controllers;

use App\Services\ZohoOAuthService;
use App\Traits\ResponseTrait;

class ZohoOAuthController extends Controller
{
    use ResponseTrait;

    public ZohoOAuthService $oauthService;

    public function __construct(ZohoOAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * @throws \Exception
     */
    public function generateToken()
    {
        $requestBody = $this->oauthService->getGenerateRequestBody();
        $responseData = $this->oauthService->makeRequest($requestBody);

        if (isset($responseData['error'])) {
            return $this->error($responseData['error']);
        }

        $preparedData = $this->oauthService->prepareData($responseData);
        $this->oauthService->saveToDb($preparedData);

        return $this->success('Tokens successfully generated');
    }

    /**
     * @throws \Exception
     */
    public function refreshToken()
    {
        if (!$this->oauthService->getRefreshToken()) {
            return $this->error('Refresh token is does not exist');
        }

        $requestBody = $this->oauthService->getRefreshRequestBody();
        $responseData = $this->oauthService->makeRequest($requestBody);

        if (isset($responseData['error'])) {
            return $this->error($responseData['error']);
        }

        $preparedData = $this->oauthService->prepareData($responseData);
        $this->oauthService->saveToDb($preparedData);

        return $this->success('Token successfully refreshed');
    }
}
