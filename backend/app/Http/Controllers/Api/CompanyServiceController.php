<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyServiceController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $services = CompanyService::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Layanan',
            'services'    => $services
        ]);
    }

    public function show($slug)
    {
        $service = CompanyService::where('slug', $slug)->first();

        if($service) {

            return response()->json([
                'success' => true,
                'message' => 'List Product By Category: '. $service->name,
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Data Product By Category Tidak Ditemukan',
            ], 404);

        }
    }
}
