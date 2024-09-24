<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('charts_cache', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->year('year_of');
            $table->json('mounth_project_categories');
            $table->json('project_local_categories');
            $table->json('staff_handled_projects_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
