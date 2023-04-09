<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SesionController extends Controller
{
    //
    function index(){
        return view('sesi.index');
    }
    public function loginReact(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    function login(Request $request){
        Session::flash('email', $request->email);
        // validasi isian
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'harap isi email',
            'password.required' => 'harap isi password'
        ]);

        // autentikasi
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            // kalau autentikasi sukses
            return redirect('recipe')->with('success', 'anda berhasil login');
        }else{
            // jika autentikasi gagal
            return redirect('')->withErrors("Email atau password salah");
        }
    }
    function logout(){
        Auth::logout();
        return redirect('')->with('success', "anda berhasil logout");
    }
    function register(){
        return view('sesi.register');
    }
    function create(Request $request){
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required|email|unique:users,email', //dicek apakah valid, termasuk cek db agar tidak dupes
            'password' => 'required|min:6',
            'name' => 'required'
        ], [
            'email.required' => 'harap isi email',
            'email.email' => 'silahkan isi email yang valid',
            'email.unique' => 'Email sudah dipakai',
            'password.required' => 'harap isi password',
            'password.min' => 'minimal harus 6 karakter',
            'name.required' => 'nama wajib diisi'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        User::create($data);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            // kalau autentikasi sukses
            return redirect('recipe')->with('success', Auth::user()->name.' Berhasil login');
        }else{
            // jika autentikasi gagal
            return redirect('sesi')->withErrors("Email atau password salah");
        }
    }
}
