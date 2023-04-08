<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyCatalogue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyCatalogueController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $catalogues = CompanyCatalogue::latest()->when(request()->q, function($catalogues) {
            $catalogues = $catalogues->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.catalogue.index', compact('catalogues'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.catalogue.create');
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
            'image'                   => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'desc'                    => 'required',
            'price'                   => 'required',
            'status_consumtion'       => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/catalogue', $image->hashName());

        //save to DB
        $service = CompanyCatalogue::create([
            'name'                   => $request->name,
            'image'                  => $image->hashName(),
            'slug'                   => Str::slug($request->name, '-'),
            'desc'                   => $request->desc,
            'price'                  => $request->price,
            'status_consumtion'      => $request->status_consumtion,
        ]);

        if($service){
             //redirect dengan pesan sukses
             return redirect()->route('admin.catalogue.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.catalogue.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
     }

       /**
     * edit
     *
     * @param  mixed $catalogue
     * @return void
     */
    public function edit(CompanyCatalogue $service)
    {
        $catalogues = CompanyCatalogue::latest()->get();
        return view('admin.catalogue.edit', compact('catalogues'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $catalogue
     * @return void
     */

     public function update(Request $request, CompanyCatalogue $catalogue)
     {
        $this->validate($request, [
            'name'                    => 'required',
            'image'                   => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'desc'                    => 'required',
            'price'                   => 'required',
            'status_consumtion'       => 'required',
        ]);

        //cek jika image kosong
        if($request->file('image') == '') {

             //update tanpa image
             $catalogue = CompanyCatalogue::findOrFail($catalogue->id);
             $catalogue->update([
                'name'                   => $request->name,
                'slug'                   => Str::slug($request->name, '-'),
                'desc'                   => $request->desc,
                'price'                  => $request->price,
                'status_consumtion'      => $request->status_consumtion,
            ]);

        } else {

             //hapus image lama
             Storage::disk('local')->delete('public/service/'.basename($catalogue->image));

             //upload image baru
             $image = $request->file('image');
             $image->storeAs('public/service', $image->hashName());

             //update dengan image
             $catalogue = CompanyCatalogue::findOrFail($catalogue->id);
             $catalogue->update([
                'name'                   => $request->name,
                'image'                  => $image->hashName(),
                'slug'                   => Str::slug($request->name, '-'),
                'desc'                   => $request->desc,
                'price'                  => $request->price,
                'status_consumtion'      => $request->status_consumtion,
            ]);
        }

        if($catalogue){
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
        $catalogue = CompanyCatalogue::findOrFail($id);
        $image = Storage::disk('local')->delete('public/service/'.basename($catalogue->image));
        $catalogue->delete();

        if($catalogue){
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
