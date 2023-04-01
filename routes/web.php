<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/halaman', [PageController::class, 'index']);
Route::get('/tentang', [PageController::class, 'about']);
Route::get('/kontak', [PageController::class, 'kontak']);

// Route::resource('siswa', SiswaController::class);

Route::get("/", [SesionController::class, "index"])->name('login');
Route::post("/login", [SesionController::class, "login"]);
Route::get("/logout", [SesionController::class, "logout"]);
Route::get("/register", [SesionController::class, "register"]);
Route::post("/create", [SesionController::class, "create"]);

Route::group(['middleware' => ['auth']], function(){
    Route::resource('recipe', RecipeController::class);
});

// Route::get('siswa', [SiswaController::class, 'index']); 
// Route::get('siswa/{id}', [SiswaController::class, 'detail'])->where('id', '[0-9]+'); 

// Route::get('/siswa/{id}', function ($id) {
//     return "<h1>Saya siswa dengan ID $id</h1>";
// })->where('id', '[0-9]+'); // agar id yang masuk hanya berupa angka saja

// Route::get('/siswa/{id}/{nama}', function ($id, $nama) {
//     return "<h1>Saya siswa dengan ID $id dan nama: $nama</h1>";
// })->where(['id' => '[0-9]+', 'nama' => '[A-Za-z]+']);