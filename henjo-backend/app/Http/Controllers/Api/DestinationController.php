<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with([
            'country',
            'media',
            'packages' => function ($query) {
                $query->limit(3);
            }
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $destinations
        ]);
    }

    public function show($slug)
    {
        $destination = Destination::with([
            'country',
            'media',
            'packages' => function ($query) {
                $query->where('status', 'published');
            }
        ])->where('slug', $slug)->first();

        if (!$destination) {
            return response()->json([
                'success' => false,
                'message' => 'Destination not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $destination
        ]);
    }
}