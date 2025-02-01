<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('module_id')->constrained()->onDelete('cascade'); // Cascade delete when module is deleted
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Cascade delete when role is deleted
            $table->json('permissions'); // JSON column to store permissions
            $table->softDeletes(); // Soft delete (deleted_at)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
