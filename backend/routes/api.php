<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Route;


/**
 * Route API Owner
 */
Route::get('/owner', [OwnerController::class, 'index'])->name('api.owner.index');

/**
 * Route API Company
 */
Route::get('/company', [CompanyController::class, 'index'])->name('api.company.index');


/**
 * Route API CompanyService
 */
Route::get('/service', [CompanyServiceController::class, 'index'])->name('api.companyservice.index');

/**
 * Route API CompanyCatalogue
 */
Route::get('/catalogue', [CompanyCatalogueController::class, 'index'])->name('api.catalogue.index');

