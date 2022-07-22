<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/reg', [App\Http\Controllers\UserRegistationController::class, 'Registation'])->name('reg');

Route::post('/reg1/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationOne'])->name('reg1.store');

Route::post('/reg2/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationTwo'])->name('reg2.store');

Route::post('/reg3/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationThree'])->name('reg3.store');



Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[App\Http\Controllers\User\UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[App\Http\Controllers\User\UserController::class,'profile'])->name('profile');
    Route::post('store_problem',[App\Http\Controllers\User\UserController::class,'Store'])->name('user.problem.store');

    Route::get('delete_problem/{id}',[App\Http\Controllers\User\UserController::class,'delete'])->name('user.problem.delete');

});

require __DIR__.'/superadmin.php';

require __DIR__.'/admin.php';

require __DIR__.'/tachnician.php';





//Auth::routes(['register'=>false]);





  
