<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SendEmailController;
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

Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');

Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update.category');

Route::get('/delete-category/{id}', [CategoryController::class, 'softDelete'])->name('soft.category.delete');

Route::get('/restore-category/{id}', [CategoryController::class, 'restore'])->name('category.restore');

Route::get('/permanently-delete-category/{id}', [CategoryController::class, 'permanentlyDelete'])->name('permanently.delete.category');

######   Brand Routes  ########
Route::get('/all-brand', [BrandController::class, 'index'])->name('all.brand');



Route::post('/sendBacancyMail', [MailController::class, 'sendMail'])->name('send.email');




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
