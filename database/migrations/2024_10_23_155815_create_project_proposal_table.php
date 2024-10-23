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
        Schema::create('project_proposal', function (Blueprint $table) {
            $table->id();
            $table->char('Project_id', 15)->nullable()->collation('utf8mb4_bin');
            $table->integer('application_id')->unsigned()->nullable();
            $table->json('data');
            $table->enum('submission_status', ['Draft', 'Submitted']);
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('application_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Project_id')->references('Project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_proposal');
    }
};
