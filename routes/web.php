<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get("/", [SesionController::class, "index"])->name('login');
Route::post("/login", [SesionController::class, "login"]);
Route::get("/logout", [SesionController::class, "logout"]);
Route::get("/register", [SesionController::class, "register"]);
Route::post("/create", [SesionController::class, "create"]);

Route::group(['middleware' => ['auth']], function(){
    Route::resource('recipe', RecipeController::class);
});