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
        Schema::create('charts_year_of', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year_of');
            $table->json('monthly_project_categories')->nullable();
            $table->json('project_local_categories')->nullable();
            $table->json('staff_handle_Projects_categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charts_cache_year_of');
    }
};
