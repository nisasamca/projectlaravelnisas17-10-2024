<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $wishlists = wishlist::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        return view('wishlist', compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wishlist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price'=>'required|numeric'

        ]);

        wishlist::create($request->all());

        return redirect()->route('wishlist.data')->with('success', 'berhasil menambah data resep!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id){
        $wishlist= wishlist::find($id);
        return view('wishlist.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wishlist = wishlist::find($id);
        return view('wishlist.edit', compact('wishlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            
        ], [
            'name.required' => 'Kolom Nama resep Harus Diisi!',
            'name.max' => 'Kolom Nama resep Maksimal 100 Karakter',
            'price.required' => 'Kolom Jenis resep Harus Diisi!',
            'price.numeric' => 'Kolom price Harus Diisi dengan angka!',

        ]);

       wishlist::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->route('wishlist.data')->with('success', 'berhasil mengubah data wishlist!!!!');

    }
    
    public function updateDescription(Request $request, $id){
        if(isset($request->description)==FALSE){
            $recipeBefore = wishlist::find($id);
            return redirect()->back()->with([
                'failed' => 'harga tidak boleh kosong!',
                'id'=>$id, 
                'price'=>$recipeBefore->description
            ]);

    }

    wishlist::where('id', $id)->update([
        'price'=> $request->price
    ]);
    return redirect()->route('wishlist.data')->with('success', 'Berhasil Mengubah Data wishlist!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        wishlist::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data wishlist!');
    }
}
