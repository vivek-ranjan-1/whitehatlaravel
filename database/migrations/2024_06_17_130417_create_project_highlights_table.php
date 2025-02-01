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
        Schema::create('project_highlights', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->constrained()->onDelete('cascade'); 
			$table->text('highlights_descp')->nullable();
			$table->integer('towers')->nullable();
			$table->integer('parking')->nullable();
			$table->float('density_unit_per_area',8,2)->nullable();
			$table->integer('no_of_apartments')->nullable();
			$table->float('lift_ratio',8,2)->nullable();
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
        Schema::dropIfExists('project_highlights');
    }
};
