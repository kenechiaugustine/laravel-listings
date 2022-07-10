<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listings;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListingController::class, 'index']);

Route::get('/{listing}', [ListingController::class, 'show']);

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/auth/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users/register', [UserController::class, 'store']);

Route::post('/auth/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/auth/login', [UserController::class, 'login'])->name(('login'))->middleware('guest');
Route::post('/users/login', [UserController::class, 'authenticate']);

Route::get('/listings/user/manage', [ListingController::class, 'manage'])->middleware('auth');






















// Route::get('/listings', function () {
//     return view('welcome', [
//         'name' => 'Augustine',
//         'listings' => Listings::all(),
//     ]);
// });


// Route::get('/hello', function () {
//     return 'Hello World';
// });

// Route::get('/api', function () {
//     return response()->json(['message' => 'Hello World']);
// });

// Route::get('/posts/{postId}', function ($postId) {
//     dd('The postId is: '.$postId);
//     return response('Post ' . $postId);
// });

// Route::get('/search', function (Response $response) {
//     dd($response->all());
// });