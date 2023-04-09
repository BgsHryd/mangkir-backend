<?php

use App\Models\favorite;
use App\Models\ingredient;
use App\Models\recipe;
use App\Models\review;
use App\Models\step_recipe;
use App\Models\tool;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use SebastianBergmann\Environment\Console;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function(){
    $users = User::get();
    return response()->json($users);
});

Route::post('/login', function (Request $request) {
    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }
    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;

        return response()->json(['token' => $token, 'email' => $request->email], 200);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
});

Route::post('/register', function(Request $request){
    $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
    ]);

    return response()->json(['message' => 'User registered successfully'], 200);
});

Route::get('/recipes', function(){
    $recipes = recipe::get();
    return response()->json($recipes);
});

Route::get('/recipe/{recipe}', function ($recipeID) {
    // your code here
    $recipes = recipe::where('recipeID', $recipeID)->first();
    $author = User::where('email', $recipes->emailAuthor)->first();
    $data_ingredients = ingredient::where('recipeID', $recipeID)->get();
    $data_tools = tool::where('recipeID', $recipeID)->get();
    $data_steps = step_recipe::where('recipeID', $recipeID)->get();

    $all_data = [
        'author' => $author,
        'data_recipe' => $recipes,
        'data_ingredients' => $data_ingredients,
        'data_tools' => $data_tools,
        'data_steps' => $data_steps,
    ];
    return response()->json($all_data);
});

Route::get('/user/email', function () {
    $user = Auth::user();
    return response()->json([
        'email' => $user->email,
    ]);
})->middleware('auth');

Route::put('/recipe/{recipe}', function(Request $request, $id){
    $rules = [
        'email' => 'required',
        'rating' => 'required|min:1|max:5',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    review::create([
        'email' => $request['email'],
        'recipeID' => $id,
        'rating' => $request['rating'],
        'deskripsi' => $request['deskripsi'],
    ]);

    $avg = review::where('recipeID', $id)->avg('rating');
    $dataUpdate = [
        'rating' => $avg,
    ];
    recipe::where('recipeID', $id)->update($dataUpdate);

    return response()->json(['message' => 'Rating posted successfully'], 200);
});

Route::get('/recipes/favorite', function(Request $request) {
    $email = $request->email;
    $data_favorites = favorite::where('email', $email)->get();
    $data_recipes = [];
    
    foreach ($data_favorites as $favorite){
        $recipeID = $favorite->recipeID;
        $recipe = recipe::where('recipeID', $recipeID)->first();
        $data_recipes[] = $recipe;
    }

    return response()->json($data_recipes);
});

Route::post('/recipes/favorite', function(Request $request) {
    $id = $request['id'];
    $email = $request['email'];
    $rules = [
        'id' => ['required', Rule::unique('favorites')->where(function ($query) use($id, $email) {
                return $query->where('id', $id)->where('email', $email);
        })],
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()){
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // add favorite
    favorite::create([
        'id' => $id,
        'email' => $email
    ]);

    return response()->json(['message' => 'Resep berhasil ditambahkan ke favorit'], 200);
});

Route::delete('/recipes/favorite/{favorite}', function($id) {
    favorite::where('id', $id)->delete();
    return response()->json(['message' => 'favorit berhasil dihapus'], 200);
});