<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\SafariPackage;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    /**
     * Get the global site settings
     */
    public function show()
    {
        $settings = SiteSetting::current();
        $settings->safari_package_count = SafariPackage::count();
        $settings->country_count = Country::count();

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }
}
