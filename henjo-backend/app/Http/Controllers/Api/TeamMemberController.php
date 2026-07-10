<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Get all active team members
     */
    public function index()
    {
        $members = TeamMember::with('media')
            ->where('is_active', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $members
        ]);
    }
}
