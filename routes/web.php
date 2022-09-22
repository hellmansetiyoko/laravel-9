<?php

use App\Http\Controllers\BiodataController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(BiodataController::class)->group(function () {
    Route::get('/biodata', 'index')->name('biodata');
    Route::post('/biodata', 'store')->name('biodata.store');
    Route::patch('/biodata/{biodata}/update', 'update')->name('biodata.update');
});
