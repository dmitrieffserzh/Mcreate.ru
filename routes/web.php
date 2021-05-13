<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

Route::pattern(	'slug',     '[a-z0-9-_\/]+');

//Route::get('/', function () {
//    return view('welcome');
//});


// PAGES
Route::get('/{slug}', [PageController::class, 'getPage']);