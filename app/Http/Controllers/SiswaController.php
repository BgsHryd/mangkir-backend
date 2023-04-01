<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = siswa::all(); // ngambil data dari model siswa, ini langsung tampil semua
        $data = siswa::orderby('nip', 'desc')->paginate(5);
        return view('siswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Session::flash('nip', $request->nip);
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        $request->validate([
            'nip'=>'required | numeric',
            'nama'=>'required',
            'alamat'=>'required'
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nip.numeric' => 'NIP harus angka',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi'
        ]);
        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];
        siswa::create($data);
        return redirect('siswa')->with('success', 'Berhasil Menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = siswa::where('nip', $id)->first();
        return view('siswa.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = siswa::where('nip', $id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required'
        ], [
            'nip.numeric' => 'NIP harus angka',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi'
        ]);
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];
        siswa::where('nip', $id)->update($data);
        return redirect('siswa')->with('success', 'Berhasil Update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        siswa::where('nip', $id)->delete();
        return redirect('siswa')->with('success', 'Berhasil Menghapus data');
    }
}
