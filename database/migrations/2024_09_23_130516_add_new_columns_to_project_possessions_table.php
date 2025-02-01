<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToProjectPossessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_possessions', function (Blueprint $table) {
            // Add new columns with 'text' type
            $table->text('launch_date_text')->nullable();
            $table->text('possession_rera_date_text')->nullable();
        });

        // Move data from old columns to new columns
        DB::statement('UPDATE project_possessions SET launch_date_text = launch_date, possession_rera_date_text = possession_rera_date');

        // Drop the old 'date' columns
        Schema::table('project_possessions', function (Blueprint $table) {
            $table->dropColumn('launch_date');
            $table->dropColumn('possession_rera_date');
        });

        // Rename the new 'text' columns to original column names
        Schema::table('project_possessions', function (Blueprint $table) {
            $table->renameColumn('launch_date_text', 'launch_date');
            $table->renameColumn('possession_rera_date_text', 'possession_rera_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate the original columns as 'date' types
        Schema::table('project_possessions', function (Blueprint $table) {
            $table->date('launch_date')->nullable();
            $table->date('possession_rera_date')->nullable();
        });

        // Move data from new 'text' columns back to 'date' columns
        DB::statement('UPDATE project_possessions SET launch_date = launch_date_text, possession_rera_date = possession_rera_date_text');

        // Drop the new 'text' columns
        Schema::table('project_possessions', function (Blueprint $table) {
            $table->dropColumn('launch_date_text');
            $table->dropColumn('possession_rera_date_text');
        });
    }
}
