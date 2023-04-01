<?php

namespace App\Http\Controllers;

use App\Models\ingredient;
use App\Models\recipe;
use App\Models\step_recipe;
use App\Models\tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = recipe::orderby('recipeID')->paginate(5);
        return view('recipe.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan form untuk membuat data baru
        return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // algoritma untuk memasukkan data baru ke database
        Session::flash('judul', $request->nip);
        Session::flash('backstory', $request->nama);
        Session::flash('asal', $request->alamat);
        Session::flash('serving', $request->nama);
        Session::flash('durasi', $request->alamat);
        $request->validate([
            'judul'=>'required',
            'serving'=>'required',
            'durasi' => 'required'
        ]);

        $data = [
            //'email_author' => dapetin email dari session yang lagi login
            'judul' => $request->input('judul'),
            'backstory' => $request->input('backstory'),
            'asal' => $request->input('asal'),
            'serving' => $request->input('serving'),
            'durasi' => $request->input('durasi'),
        ];
        recipe::create($data);
        return redirect('recipe')->with('success', 'Berhasil Menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = recipe::where('recipeID', $id)->first();
        $data_ingredients = ingredient::where('recipeID', $id)->get();
        $data_tools = tool::where('recipeID', $id)->get();
        $data_steps = step_recipe::where('recipeID', $id)->get();

        return view('recipe.show', [
            'data' => $data,
            'data_ingredients' => $data_ingredients,
            'data_tools' => $data_tools,
            'data_steps' => $data_steps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        recipe::where('recipeID', $id)->delete();
        return redirect('recipe')->with('success', 'Berhasil Menghapus data');
    }
}
