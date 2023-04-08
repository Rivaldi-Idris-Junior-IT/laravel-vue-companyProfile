<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanySocialMedia;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySocialMediaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $socials = CompanySocialMedia::latest()->when(request()->q, function($socials) {
            $socials = $socials->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.socialmedia.index', compact('socials'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.socialmedia.create');
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
            'link'                    => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/socialmedia', $image->hashName());

        //save to DB
        $social = CompanySocialMedia::create([
            'name'                   => $request->name,
            'image'                  => $image->hashName(),
            'slug'                   => Str::slug($request->name, '-'),
            'link'                   => $request->link,
        ]);

        if($social){
             //redirect dengan pesan sukses
             return redirect()->route('admin.socialmedia.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
            //redirect dengan pesan error
            return redirect()->route('admin.socialmedia.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $social = CompanySocialMedia::findOrFail($id);
        $image = Storage::disk('local')->delete('public/socialmedia/'.basename($social->image));
        $social->delete();

        if($social){
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
