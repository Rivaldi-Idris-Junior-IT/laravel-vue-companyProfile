<?php

namespace App\Http\Controllers\Admin;

use App\Models\Owner;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $owners = Owner::latest()->when(request()->q, function($owners) {
            $owners = $owners->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.owner.index', compact('owners'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.owner.create');
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
            'name'                            => 'required',
            'image'                           => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'status'                          => 'required',
            'moto'                            => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/owner', $image->hashName());

        //save to DB
        $owner = Owner::create([
            'name'                   => $request->name,
            'slug'                   => Str::slug($request->name, '-'),
            'image'                  => $image->hashName(),
            'status'                 => $request->status,
            'moto'                   => $request->moto,
        ]);

        if($owner){
             //redirect dengan pesan sukses
             return redirect()->route('admin.owner.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
            //redirect dengan pesan error
            return redirect()->route('admin.onwer.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $owner = Owner::findOrFail($id);
        $image = Storage::disk('local')->delete('public/owner/'.basename($owner->image));
        $owner->delete();

        if($owner){
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
