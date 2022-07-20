<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('tachnician_id')->nullable();
            $table->text('tachnician_details')->nullable();
            $table->string('officer_id')->nullable();
            $table->text('officer_details')->nullable();
            $table->text('equipment_details')->nullable();
            $table->text('solve_note')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('problem_title')->nullable();
            $table->longText('problem_details')->nullable()->default('text');
            $table->string('room_number')->nullable();
            $table->string('floor_number')->nullable(); 
            $table->string('equipment_number')->nullable(); 
            $table->string('feedback')->nullable(); 
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('officer_status')->nullable()->default(0);
            $table->string('officer_feedback')->nullable(); 
            $table->string('technician_id')->nullable(); 
            $table->boolean('technician_status')->nullable()->default(0);
            $table->string('technician_feedback')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
};
