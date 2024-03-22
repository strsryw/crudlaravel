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

Route::get('/get-all-data', [BiodataController::class, 'getAllData']);
Route::post('/get-all-data', [BiodataController::class, 'getAllData']);
Route::get('/', [BiodataController::class, 'index']);
Route::post('/insert', [BiodataController::class, 'create']);
Route::post('/delete/{id}', [BiodataController::class, 'destroy']);
Route::post('/update/{id}', [BiodataController::class, 'update']);






Route::get('/about', function () {
    return view('about', [
        'title' => 'About'
    ]);
});

Route::get('/blog', function () {
    return view('blog', [
        'title' => 'Blog'
    ]);
});
