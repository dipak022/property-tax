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
        Schema::create('poperty_taxes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('divition')->nullable();
            $table->string('municipality')->nullable();
            $table->string('ward')->nullable();
            $table->date('block')->nullable();
            $table->string('subblock')->nullable();
            $table->string('poperty_tax')->nullable();
            $table->string('holding_number')->nullable();
            $table->string('image')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->boolean('active')->nullable()->default(1);
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
        Schema::dropIfExists('poperty_taxes');
    }
};
