<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_file_links', function (Blueprint $table) {
            $table->id();
            $table->char('Project_id', 32)->collation('utf8mb4_bin');
            $table->string('file_name', 64)->unique();
            $table->string('file_link', 500)->unique();
            $table->timestamps();
            $table->foreign('Project_id')->references('Project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_file_links');
    }
};
