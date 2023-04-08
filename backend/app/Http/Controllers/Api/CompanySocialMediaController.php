<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanySocialMedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySocialMediaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $socials = CompanySocialMedia::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Social Media',
            'socials'    => $socials
        ]);
    }
}
