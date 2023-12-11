<?php

namespace App\Http\Controllers;

use App\Models\ingredient;
use App\Models\recipe;
use App\Models\review;
use App\Models\step_recipe;
use App\Models\tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        if (request()->segment(1) == 'api') return response()->json([
            'error' => false,
            'list' => $data
        ]);
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
        // $email = $request->input('email');
        
        // Session::flash('email', $request->email);
        Session::flash('judul', $request->judul);
        Session::flash('backstory', $request->backstory);
        Session::flash('asal', $request->asal);
        Session::flash('serving', $request->serving);
        Session::flash('durasi', $request->durasi);
        Session::flash('kategori', $request->kategori);
        $request->validate([
            'judul'=>'required',
            'serving'=>'required',
            'durasi' => 'required',
            'foto' => 'mimes:jpeg,jpg,png,gif'
        ],[
            'foto.mimes' => 'Foto hanya diperbolehkan berekstensi .JPEG, .JPG, .PNG dan .GIF'
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi =$foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);

        $data = [
            'emailAuthor' => Auth::user()->email,
            'judul' => $request->input('judul'),
            'backstory' => $request->input('backstory'),
            'asalDaerah' => $request->input('asal'),
            'kategori' => $request->input('kategori'),
            'servings' => $request->input('serving'),
            'durasi_menit' => $request->input('durasi'),
            'foto' => $foto_nama
        ];
        // return dd($data);
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
        $data = recipe::where('recipeID', $id)->first();
        $data_ingredients = ingredient::where('recipeID', $id)->get();
        $data_tools = tool::where('recipeID', $id)->get();
        $data_steps = step_recipe::where('recipeID', $id)->orderby('urutan')->get();

        return view('recipe.update', [
            'data' => $data,
            'data_ingredients' => $data_ingredients,
            'data_tools' => $data_tools,
            'data_steps' => $data_steps,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update recipes table
        $recipe = recipe::where('recipeID', $id)->first();
        $recipe->judul = $request->input('judul');
        $recipe->backstory = $request->input('background');
        $recipe->asalDaerah = $request->input('asal');
        $recipe->servings = $request->input('porsi');
        $recipe->durasi_menit = $request->input('durasi');
        $recipe->kategori = $request->input('kategori');

        //update ingredients table
        //update ingredients table
        if ($request->has('ingredients')){
            foreach ($request->input('ingredients') as $key => $value) {
                $data_ingre = [
                    'quantity' => $value['quantity'],
                    'unit' => $value['unit'],
                    'ingredient_name' => $value['name'],
                ];
                ingredient::where('ingredientID', $key)->update($data_ingre);
            }
        }
        
        // update tools table
        if ($request->has('tools')){
            foreach ($request->input('tools') as $key => $value){
                $data_tool = [
                    'nama_alat' => $value['nama_alat'],
                ];
                tool::where('toolID', $key)->update($data_tool);
            }
        }

        // update step_recipes table
        if ($request->has('steps')){
            foreach($request->input('steps') as $key => $value){
                $data_step = [
                    'deskripsi' => $value['deskripsi'],
                ];
                step_recipe::where('stepID', $key)->update($data_step);
            }
        }

        //pengecekan sudah ada foto untuk update data
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
            ],[
                'foto.mimes' => 'Foto hanya diperbolehkan berekstensi .JPEG, .JPG, .PNG dan .GIF'
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi =$foto_file->extension();
            $foto_nama = date('ymdhis').".".$foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama);

            $data_foto = recipe::where('recipeID', $id)->first();
            File::delete(public_path('foto'.'/'.$data_foto->foto));

            $data = [
                'foto' => $foto_nama
            ];
            recipe::where('recipeID', $id)->update($data);
        }

        return redirect('recipe')->with('success', 'Berhasil Update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = recipe::where('recipeID', $id)->first();
        File::delete(public_path('foto'.'/'.$data->foto));
        recipe::where('recipeID', $id)->delete();
        return redirect('recipe')->with('success', 'Berhasil Menghapus data');
    }
}
