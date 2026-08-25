<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\InquiryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SafariPackageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ✅ Test route
Route::get('/hello', function () {
    return response()->json(['message' => 'API is working!']);
});

// ✅ API V1 Routes
Route::prefix('v1')->group(function () {
    // Safari Packages
    Route::get('/safaris', [SafariPackageController::class, 'index']);
    Route::get('/safaris/featured', [SafariPackageController::class, 'featured']);
    Route::get('/safaris/popular', [SafariPackageController::class, 'popular']);
    Route::get('/safaris/filters', [SafariPackageController::class, 'filterOptions']);
    Route::get('/safaris/{slug}', [SafariPackageController::class, 'show']);

    // Destinations
    Route::get('/destinations', [DestinationController::class, 'index']);
    Route::get('/destinations/{slug}', [DestinationController::class, 'show']);

    // Blog Posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/featured', [PostController::class, 'featured']);
    Route::get('/posts/tags', [PostController::class, 'tags']);
    Route::get('/posts/tag/{slug}', [PostController::class, 'postsByTag']);
    Route::get('/posts/{slug}', [PostController::class, 'show']);

    // Team Members
    Route::get('/team-members', [TeamMemberController::class, 'index']);

    // Activities
    Route::get('/activities', [ActivityController::class, 'index']);

    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index']);

    // Site Settings
    Route::get('/settings', [SettingController::class, 'show']);

    // Menus
    Route::get('/menus/{location}', [MenuController::class, 'show']);

    // Pages
    Route::get('/pages/{slug}', [PageController::class, 'show']);

    // Inquiries
    Route::post('/inquiries', [InquiryController::class, 'store']);

    // Bookings
    Route::post('/bookings', [BookingController::class, 'store']);
});
