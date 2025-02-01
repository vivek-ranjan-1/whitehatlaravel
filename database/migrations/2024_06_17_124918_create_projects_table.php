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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
			$table->string('name', 100)->nullable();
			$table->string('owner_name', 100)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('featured_image', 255)->nullable();
			$table->string('delivery_status', 100)->nullable();
			$table->string('rera_no')->nullable();
			$table->float('min_price',12,2)->nullable();
			$table->float('max_price',12,2)->nullable();
			$table->string('land_area',55)->nullable();
			$table->string('bhk_types',55)->nullable();
			$table->string('location',100)->nullable();
			$table->string('city',255)->nullable();
			$table->string('title',255)->nullable();
			$table->string('youtube_link',255)->nullable();
			$table->string('keywords',255)->nullable();
			$table->string('meta_tags',255)->nullable();
			$table->string('meta_description',255)->nullable();
			$table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
