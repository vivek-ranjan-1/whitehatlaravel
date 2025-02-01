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
        Schema::create('project_floor_plans', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->constrained()->onDelete('cascade'); 
			$table->text('floor_plans_data')->nullable();
			$table->text('floor_plans_descp')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_floor_plans');
    }
};
