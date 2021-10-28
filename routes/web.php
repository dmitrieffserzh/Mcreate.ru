<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RequestFormController;

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

Route::pattern( 'slug', '[a-z0-9-_\/]+' );

// SERVICES
Route::get( '/services/{slug}', [ ServiceController::class, 'show' ] )->name( 'services.show' );

// WORKS
Route::get( '/works/{slug}',    [ WorkController::class, 'show' ] )->name( 'works.show' );

// PAGES
Route::get( '/',                [ PageController::class, 'index' ] );
Route::get( '/{slug}',          [ PageController::class, 'getPage' ] );

// FORMS
Route::post( 'send',            [ RequestFormController::class, 'sendFormFeedback' ] );