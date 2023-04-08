<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $companies = Company::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Company',
            'companies'    => $companies
        ]);
    }

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->first();

        if($company) {

            return response()->json([
                'success' => true,
                'message' => 'List Product By Category: '. $company->name,
                "owner" => $company->owner()->latest()->get(),
                "companyservice" => $company->companyservice()->latest()->get(),
                "companysocial" => $company->companysocial()->latest()->get()
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Data Product By Category Tidak Ditemukan',
            ], 404);

        }
    }
}
