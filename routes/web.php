<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// about
Route::get('/about', function () {
    return view('about');
})->middleware("check");

Route::get('/home', function () {
    echo "home page";
});


// contract
Route::get('/contract', [ContractController::class, 'index'])->name('contract.us');

// category route
Route::get('/all-category', [CategoryController::class, 'index'])->name('all.category');

Route::post('/add-category', [CategoryController::class, 'store'])->name('add.category');


// Jetstream defult Route

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        // By using model
        $users = User::all();

        // By using query
        // $users = DB::table("users")->get();

        return view('dashboard', compact("users"));
    })->name('dashboard');
});
