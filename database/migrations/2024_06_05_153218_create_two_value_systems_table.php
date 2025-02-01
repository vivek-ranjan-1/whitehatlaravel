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
        Schema::create('two_value_systems', function (Blueprint $table) {
            $table->id();
			$table->string('title')->nullable();
            $table->text('description')->nullable(); 
            $table->text('white_hat_advice')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
			 $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('two_value_systems');
    }
};
