<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{
    //
    function login(){
        return view('login.index');
    }
    function register(){
        return view('register.index');
    }
}
