<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;

 

Route::get('/', function () {
    return view('welcome');
});

// about
Route::get('/about', function () {
    return view('about');
})->middleware("check");

Route::get('/home', function(){
    echo "home page";
});


// contract
Route::get('/contract', [ContractController::class, 'index'])->name('contract.us');