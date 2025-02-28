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
        Schema::create('project_forms', function (Blueprint $table) {
            $table->id();
            $table->char('project_info_id', 15)->collation('utf8mb4_bin');
            $table->bigInteger('application_form_id')->unsigned();
            $table->bigInteger('business_info_id')->unsigned();
            $table->string('key', 64);
            $table->json('data');
            $table->timestamps();

            $table->foreign('project_info_id')->references('Project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_info_id')->references('id')->on('application_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_forms');
    }
};
