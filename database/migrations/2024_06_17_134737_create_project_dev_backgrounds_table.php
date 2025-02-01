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
        Schema::create('project_dev_backgrounds', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->constrained()->onDelete('cascade'); 
			$table->text('dev_backgrounds_descp')->nullable();
			$table->float('experience',12,2)->nullable();
			$table->integer('projects_delivered')->nullable();
			$table->string('ongoing_projects',255)->nullable();
			$table->string('area_built',255)->nullable();
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
        Schema::dropIfExists('project_dev_backgrounds');
    }
};
