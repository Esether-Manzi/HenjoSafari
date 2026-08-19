<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Get the menu tree for a given location (e.g. navbar, footer)
     */
    public function show(string $location)
    {
        $items = Menu::location($location)
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }
}
