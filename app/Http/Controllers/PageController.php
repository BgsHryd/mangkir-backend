<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    function index(){
        return view("halaman.index");
    }
    function about(){
        return view("halaman.tentang");
    }
    function kontak(){
        $judul = 'Halaman Kontak';
        $data = [
            'judul' => 'Ini adalah Halaman Kontak',
            'kontak' => [
                'email' => 'masbro@gmail.com',
                'youtube' => 'Ada Masbroooo'
            ]
        ];
        return view("halaman.kontak")->with($data);
        // return view("halaman.kontak")->with('halaman_judul', $judul);
    }
}
