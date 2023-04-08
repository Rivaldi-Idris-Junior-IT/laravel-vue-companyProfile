<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Owner;
use App\Models\CompanyService;
use App\Models\CompanySocialMedia;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $companies = Company::latest()->when(request()->q, function($companies) {
            $companies = $companies->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);



        return view('admin.company.index', compact('companies'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $owners = Owner::latest()->get();
        $services = CompanyService::latest()->get();
        $socials = CompanySocialMedia::latest()->get();
        return view('admin.company.create', compact('owners','services','socials'));
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

     public function store(Request $request)
    {
       $this->validate($request, [
           'name'                    => 'required',
           'email_company'           => 'required',
           'about'                   => 'required',
           'address'                 => 'required',
           'phone'                   => 'required',
           'owner_id'                => 'required',
           'company_service_id'      =>  'required',
           'company_social_media_id' => 'required'
       ]);
       //save to DB
       $company = Company::create([
           'name'                   => $request->name,
           'email_company'          => $request->email_company,
           'slug'                   => Str::slug($request->name, '-'),
           'about'                  => $request->about,
           'address'                => $request->address,
           'phone'                  => $request->phone,
           'owner_id'               => $request->owner_id,
           'company_service_id'     => $request->company_service_id,
           'company_social_media_id'=> $request->company_social_media_id,
       ]);

       if($company){
            //redirect dengan pesan sukses
            return redirect()->route('admin.company.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.company.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * edit
     *
     * @param  mixed $company
     * @return void
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

      /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $company
     * @return void
     */

     public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name'                      => 'required',
            'email_company'             => 'required',
            'about'                     => 'required',
            'address'                   => 'required',
            'phone'                     => 'required',
            'owner_id'                  => 'required',
            'company_service_id'        => 'required',
            'company_social_media_id'   => 'required',
        ]);

            //update data tanpa image
            $company = Company::findOrFail($company->id);
            $company->update([
                'name'                   => $request->name,
                'email_company'          => $request->email_company,
                'slug'                   => Str::slug($request->name, '-'),
                'about'                  => $request->about,
                'address'                => $request->address,
                'phone'                  => $request->phone,
                'owner_id'               => $request->owner_id,
                'company_service_id'     => $request->company_service_id,
                'company_social_media_id'=> $request->company_social_media_id,
            ]);
        if($company){
            //redirect dengan pesan sukses
            return redirect()->route('admin.company.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.company.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

       /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */

     public function destroy($id)
     {
         $company = Company::findOrFail($id);
         $company->delete();

         if($company){
             return response()->json([
                 'status' => 'success'
             ]);
         }else{
             return response()->json([
                 'status' => 'error'
             ]);
         }
     }
}
