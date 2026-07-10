<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SafariPackage;
use App\Models\SafariCategory;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\Country;
use Illuminate\Http\Request;

class SafariPackageController extends Controller
{
    /**
     * Get all safari packages with pagination and filtering
     */
    public function index(Request $request)
    {
        $query = SafariPackage::with([
            'destination.country',
            'categories',
            'activities',
            'accommodations',
            'itineraryDays',
            'inclusions',
            'exclusions'
        ])
        ->where('status', 'published');

        // Text Search
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('summary', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('categories', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Destination Filter
        if ($request->filled('destination')) {
            $destinationSlug = $request->input('destination');
            $query->whereHas('destination', function($q) use ($destinationSlug) {
                $q->where('slug', $destinationSlug);
            });
        }

        // Activity Filter
        if ($request->filled('activity')) {
            $activitySlug = $request->input('activity');
            $query->whereHas('activities', function($q) use ($activitySlug) {
                $q->where('slug', $activitySlug);
            });
        }

        // Country Filter
        if ($request->filled('country')) {
            $countryNameOrSlug = $request->input('country');
            $query->whereHas('destination.country', function($q) use ($countryNameOrSlug) {
                $q->where('name', 'like', "%{$countryNameOrSlug}%")
                  ->orWhere('code', 'like', "%{$countryNameOrSlug}%");
            });
        }

        // Pagination
        $packages = $query->paginate(12);

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
            'destination.country',
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
            'destination.country',
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
            'destination.country',
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

    /**
     * Get all search and filter options in one call
     */
    public function filterOptions()
    {
        $categories = SafariCategory::all(['id', 'name', 'slug']);
        $destinations = Destination::all(['id', 'name', 'slug']);
        $activities = Activity::all(['id', 'name', 'slug']);
        $countries = Country::all(['id', 'name', 'code']);

        return response()->json([
            'success' => true,
            'data' => [
                'categories' => $categories,
                'destinations' => $destinations,
                'activities' => $activities,
                'countries' => $countries,
            ]
        ]);
    }
}