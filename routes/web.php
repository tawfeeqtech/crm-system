<?php

use App\Enums\StatusClients;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Role\RemoveRoleFromUser;
use App\Http\Controllers\Permission\RevokePermissionFromRole;
use App\Http\Controllers\Permission\RevokePermissionFromUser;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/', '/login');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class)->except('show');
    Route::resource('/permissions', PermissionController::class)->except('show');
    Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRole::class)->name('roles.permissions.destroy');

    Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUser::class)
        ->name('users.permissions.destroy');
    Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUser::class)
        ->name('users.roles.destroy');
});

Route::resource('clients', ClientController::class);
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);


Route::get('/api/status-options', function () {
    return StatusClients::values();
});
require __DIR__ . '/auth.php';
