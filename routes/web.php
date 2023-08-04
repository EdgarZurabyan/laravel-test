<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HousekeepingController;
use App\Http\Controllers\DataController;


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
Route::get('/', [HousekeepingController::class, 'reportForSeptember']);
Route::get('/show-data/{date}', [DataController::class, 'showData'])->name('show-data');



