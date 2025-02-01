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
        Schema::create('project_possessions', function (Blueprint $table) {
            $table->id();
			$table->foreignId('project_id')->constrained()->onDelete('cascade'); 
			$table->text('possessions_descp')->nullable();
			// $table->date('launch_date')->nullable(); 
			// $table->date('possession_rera_date')->nullable();
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
        Schema::dropIfExists('project_possessions');
    }
};
