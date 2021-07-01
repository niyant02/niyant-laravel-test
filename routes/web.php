<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/images', [DashboardController::class, 'showImage'])->middleware(['auth'])->name('dashboard.image');
Route::post('/token/create', [DashboardController::class, 'create'])->middleware(['auth'])->name('token.create');
Route::post('/token/revoke/{id}', [DashboardController::class, 'delete'])->middleware(['auth'])->name('token.delete');

require __DIR__ . '/auth.php';
