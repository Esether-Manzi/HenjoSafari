<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SafariPackage;
use Illuminate\Http\Request;

class SafariPackageController extends Controller
{
    /**
     * Get all safari packages with pagination
     */
    public function index()
    {
        $packages = SafariPackage::with([
            'destination',
            'categories',
            'activities',
            'accommodations',
            'itineraryDays',
            'inclusions',
            'exclusions'
        ])
        ->where('status', 'published')
        ->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $packages
        ]);
    }

    /**
     * Get a single safari package by slug
     */
    public function show($slug)
    {
        $package = SafariPackage::with([
            'destination',
            'categories',
            'activities',
            'accommodations',
            'itineraryDays',
            'inclusions',
            'exclusions'
        ])
        ->where('slug', $slug)
        ->where('status', 'published')
        ->first();

        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $package
        ]);
    }

    /**
     * Get featured safari packages
     */
    public function featured()
    {
        $packages = SafariPackage::with([
            'destination',
            'categories',
            'activities',
            'accommodations'
        ])
        ->where('featured', true)
        ->where('status', 'published')
        ->limit(6)
        ->get();

        return response()->json([
            'success' => true,
            'data' => $packages
        ]);
    }

    /**
     * Get popular safari packages
     */
    public function popular()
    {
        $packages = SafariPackage::with([
            'destination',
            'categories',
            'activities',
            'accommodations'
        ])
        ->where('popular', true)
        ->where('status', 'published')
        ->limit(6)
        ->get();

        return response()->json([
            'success' => true,
            'data' => $packages
        ]);
    }
}