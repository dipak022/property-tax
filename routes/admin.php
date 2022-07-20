<?php

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.dashboard');
    
    Route::get('show_officer_problem',[App\Http\Controllers\Admin\AdminController::class,'show'])->name('show.officer.problem');
    Route::post('equipment_update/{id}',[App\Http\Controllers\Admin\AdminController::class,'EquipmentUpdate'])->name('equipment.update');
   

   
});