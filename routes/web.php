<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', function () {
    return view('landing');
});
// Route::middleware('guest')->group(function () {
//     Route::get('login', [UserController::class, 'login'])->name('login');
//     Route::post('login', [UserController::class, 'loginUser'])->name('loginUser');
//     Route::get('register', [UserController::class, 'register'])->name('register');
//     Route::post('register', [UserController::class, 'registerUser'])->name('registerUser');
// });
// Route::middleware('auth:sanctum')->group(function () {
//         Route::post('logout', [UserController::class, 'logout'])->name('logout');
//     });
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('/activity', [ProductController::class,'activity'])->name('products.activity');
    Route::post('/assign/{id}', [TaskController::class,'assign'])->name('tasks.assign');
});

