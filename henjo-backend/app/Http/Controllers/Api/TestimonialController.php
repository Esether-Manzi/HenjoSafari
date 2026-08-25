<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Get featured testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::with('media')
            ->where('featured', true)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $testimonials,
        ]);
    }
}
