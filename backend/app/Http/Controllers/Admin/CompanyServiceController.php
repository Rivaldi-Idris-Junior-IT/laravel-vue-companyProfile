<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyService;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompanyServiceController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $services = CompanyService::latest()->when(request()->q, function($services) {
            $services = $services->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.service.index', compact('services'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.service.create');
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
            'name_service'                    => 'required',
            'image'                           => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'service_desc'                    => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/service', $image->hashName());

        //save to DB
        $service = CompanyService::create([
            'image'                          => $image->hashName(),
            'name_service'                   => $request->name_service,
            'slug'                           => Str::slug($request->name_service, '-'),
            'service_desc'                   => $request->service_desc,
        ]);

        if($service){
             //redirect dengan pesan sukses
             return redirect()->route('admin.service.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
            //redirect dengan pesan error
            return redirect()->route('admin.service.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

     /**
     * edit
     *
     * @param  mixed $service
     * @return void
     */
    public function edit(CompanyService $service)
    {
        $services = CompanyService::latest()->get();
        return view('admin.service.edit', compact('services'));
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $service
     * @return void
     */

    public function update(Request $request, CompanyService $service)
     {
        $this->validate($request, [
            'name_service'                    => 'required',
            'image'                           => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'service_desc'                    => 'required',
        ]);

        //cek jika image kosong
        if($request->file('image') == '') {

             //update tanpa image
             $service = CompanyService::findOrFail($service->id);
             $service->update([
                'name_service'                   => $request->name,
                'slug'                           => Str::slug($request->name_service, '-'),
                'service_desc'                   => $request->service_desc,
             ]);

        } else {

             //hapus image lama
             Storage::disk('local')->delete('public/service/'.basename($service->image));

             //upload image baru
             $image = $request->file('image');
             $image->storeAs('public/service', $image->hashName());

             //update dengan image
             $service = CompanyService::findOrFail($service->id);
             $service->update([
                'image'                          => $image->hashName(),
                'name_service'                   => $request->name,
                'slug'                           => Str::slug($request->name_service, '-'),
                'service_desc'                   => $request->service_desc,
             ]);
        }

        if($service){
             //redirect dengan pesan sukses
             return redirect()->route('admin.service.index')->with(['success' => 'Data Berhasil Diupdate!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.service.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $service = CompanyService::findOrFail($id);
        $image = Storage::disk('local')->delete('public/service/'.basename($service->image));
        $service->delete();

        if($service){
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
