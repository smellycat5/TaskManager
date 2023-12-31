<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
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
    Route::resource('projects.tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('sprints', SprintController::class)->except('index');
    Route::get('/activity', [ProductController::class, 'activity'])->name('products.activity');
    Route::prefix('project')->group(function () {
        Route::post('/{project}/assign/{task}', [TaskController::class, 'assign'])->name('tasks.assign');
        Route::get('/{project}/sprints', [SprintController::class, 'index'])->name('sprints.index');
        Route::get('/{project}/sprints', [SprintController::class, 'create'])->name('sprints.create2');
        Route::post('/{project}/sprints', [SprintController::class, 'store'])->name('sprints.store2');
        Route::get('/{project}/users',[ProjectController::class, 'users'])->name('project.users');
        Route::post('/{project}/users/{user}',[ProjectController::class, 'addUsers'])->name('project.addUsers');
        Route::delete('/{project}/users/{user}',[ProjectController::class, 'removeUser'])->name('project.deleteUsers');

    });
    Route::post('/tasks/{task}/assign', [TaskController::class, 'toSprint'])->name('tasks.toSprint');
});
