<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
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

Route::get('/', [AuthController::class, 'view'])->name('login');
Route::get('/sign-up', [AuthController::class, 'registerView'])->name('auth.view.signup');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/sign-out', [AuthController::class, 'logout'])->name('auth.signout');

Route::group([
    'middleware' => 'auth'
], function() {
    Route::group([ 'prefix' => 'note', 'as' => 'note.'], function() {
        Route::get('/', [NoteController::class, 'view'])->name('view');
        Route::get('/{id}', [NoteController::class, 'detail'])->name('detail');
        Route::post('/', [NoteController::class, 'create'])->name('create');
        Route::post('/index', [NoteController::class, 'index'])->name('index');
        Route::put('/{id}', [NoteController::class, 'update'])->name('update');
        Route::delete('/{id}', [NoteController::class, 'destroy'])->name('delete');
    });
});
