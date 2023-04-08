<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

/**
 * route for admin
 */

//group route with prefix "admin"

Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //route company
        Route::resource('/company', CompanyController::class, ['as' => 'admin']);

        //route owner
        Route::resource('/owner', OwnerController::class, ['as' => 'admin']);

        //route CompanyService
        Route::resource('/service', CompanyServiceController::class, ['as' => 'admin']);

        //route CompanyCatalogue
        Route::resource('/catalogue', CompanyCatalogueController::class, ['as' => 'admin']);

        //route company
        Route::resource('/socialmedia', CompanySocialMediaController::class, ['as' => 'admin']);

    });
});
