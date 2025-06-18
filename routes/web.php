<?php

use App\Http\Controllers\Customers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('wizard-form');
});

Route::post('/customers', StoreController::class);
