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
        $activities = Activity::with('media')->get();

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }
}
