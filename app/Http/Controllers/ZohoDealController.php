<?php

namespace App\Http\Controllers;

use App\Services\ZohoModuleService;
use Illuminate\Http\Request;

class ZohoDealController extends Controller
{
    public const DEAL_MODULE = 'Deals';

    public ZohoModuleService $moduleService;

    public function __construct(ZohoModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function addDeal(Request $request)
    {
        $url = $this->moduleService->getRequestUrl(self::DEAL_MODULE);
        $requestBody = $this->moduleService->getRequestBody($request->all());

        return $this->moduleService->makeRequest($url, $requestBody);
    }
}
