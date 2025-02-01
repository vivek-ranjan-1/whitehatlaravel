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
        Schema::create('newsletter_messages', function (Blueprint $table) {
            $table->id();
			$table->text('title')->nullable();
            $table->string('date', 255)->nullable();
            $table->string('time', 255)->nullable();
            $table->text('message')->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('newsletter_messages');
    }
};
