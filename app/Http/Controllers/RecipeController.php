<?php

namespace App\Http\Controllers;

use App\Models\recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recipes = Recipe::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        return view('pages.recipe', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'description'=>'required'
        ]);

        Recipe::create($request->all());

        return redirect()->route('recipe.data')->with('success', 'berhasil menambah data resep!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('recipe.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Kolom Nama resep Harus Diisi!',
            'name.max' => 'Kolom Nama resep Maksimal 100 Karakter',
            'type.required' => 'Kolom Jenis resep Harus Diisi!',
            'description.required' => 'Kolom deskripsi Harus Diisi!',

        ]);

        Recipe::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description
        ]);

        return redirect()->route('recipe.data')->with('success', 'berhasil mengubah data resep!!!!');

    }
    
    public function updateDescription(Request $request, $id){
        if(isset($request->description)==FALSE){
            $recipeBefore = Recipe::find($id);
            return redirect()->back()->with([
                'failed' => 'deskripsi tidak boleh kosong!',
                'id'=>$id, 
                'description'=>$recipeBefore->description
            ]);

    }

    Recipe::where('id', $id)->update([
        'description'=> $request->description
    ]);
    return redirect()->route('recipe.data')->with('success', 'Berhasil Mengubah Data resep!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Recipe::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data resep!');
    }
}
