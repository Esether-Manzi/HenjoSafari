<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Get all activities
     */
    public function index()
    {
        // Only "featured" activities are shown — package detail pages still
        // display every activity a package is actually tagged with, this
        // endpoint just backs the homepage's curated showcase.
        $activities = Activity::with('media')->where('featured', true)->get();

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }
}
