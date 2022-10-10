<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
Route::get('/', function(){
    return redirect()->route('dashboard');
});
Route::localized(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::group(['middleware' => ['role:super_admin|author']], function () {
            Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
            Route::post('/post', [PostController::class, 'store'])->name('post.store');
        });
        Route::get('/posts', [PostController::class, 'index'])->name('post.index');
        Route::get('/posts/{slug}', [PostController::class, 'get'])->name('post.get');
    });
});
