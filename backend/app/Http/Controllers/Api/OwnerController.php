<?php

namespace App\Http\Controllers\Api;

use App\Models\Owner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $owner = Owner::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Company',
            'owner'    => $owner
        ]);
    }

}
