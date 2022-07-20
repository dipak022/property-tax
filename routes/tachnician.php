<?php

Route::group(['prefix'=>'tachnician', 'middleware'=>['isTechnician','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[App\Http\Controllers\Tachnician\TachnicianController::class,'index'])->name('technician.dashboard');
    
    Route::get('show_technician_problem',[App\Http\Controllers\Tachnician\TachnicianController::class,'show'])->name('show.technician.problem');
    Route::post('officer_assign_update/{id}',[App\Http\Controllers\Tachnician\TachnicianController::class,'OfficerUpdate'])->name('officer.assign.update');
    Route::post('solve_update/{id}',[App\Http\Controllers\Tachnician\TachnicianController::class,'SolveUpdate'])->name('solve.update');
   


});