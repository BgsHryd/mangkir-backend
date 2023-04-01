<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    function index(){
        // $data = siswa::all(); // ngambil data dari model siswa, ini langsung tampil semua
        $data = siswa::orderby('nip', 'desc')->paginate(2);
        return view('siswa.index')->with('data', $data);
    }
    function detail($id){
        $data = siswa::where('nip', $id)->first();
        return view('siswa.show')->with('data', $data);
        // return "<h1>Saya siswa dengan ID $id</h1>";
    }
    function create(){
        
    }
    function delete(){
        
    }
}
