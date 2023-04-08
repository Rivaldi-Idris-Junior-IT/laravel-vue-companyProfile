<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyCatalogue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyCatalogueController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $catalogues = CompanyCatalogue::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Catalogue',
            'catalogues'    => $catalogues
        ]);
    }
}
