<?php

namespace App\Http\Controllers;

use App\Services\ZohoModuleService;
use Illuminate\Http\Request;

class ZohoContactController extends Controller
{
    public const CONTACT_MODULE = 'Contacts';

    public ZohoModuleService $moduleService;

    public function __construct(ZohoModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function addContact(Request $request)
    {
        $url = $this->moduleService->getRequestUrl(self::CONTACT_MODULE);
        $requestBody = $this->moduleService->getRequestBody($request->all());

        return $this->moduleService->makeRequest($url, $requestBody);
    }
}
