<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ControlandoPah;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    $posts = [];
    if (auth()->check()) {
    $posts = auth()->user()->relationUserPost()->latest()->get();
    }
    //$posts = Post::where('user_id', auth()->id())->get(); // capturando os posts do usuário logado
    return view('home', ['posts'=> $posts]);
});
Route::post('/register', [ControlandoPah::class, 'register']);
Route::post('/logout', [ControlandoPah::class, 'logout']);
Route::post('/login', [ControlandoPah::class, 'login']);

//  handle posts requests
Route::post('/create-post', [PostController::class, 'createPostBlog']);
Route::get('/edit/{post}', [PostController::class, 'showPost']);
Route::put('/edit/{post}', [PostController::class, 'editPost']);
Route::delete('/delete/{post}', [PostController::class, 'deletePost']);
