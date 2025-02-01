<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Module name
            $table->string('url')->unique(); // URL of the module
            $table->text('short_description'); // Short description of the module
            $table->softDeletes(); // deleted_at column for soft deletes
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
