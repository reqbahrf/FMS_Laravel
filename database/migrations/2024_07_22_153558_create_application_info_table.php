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
        Schema::create('application_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('business_id')->unsigned();
            $table->char('Project_id', 15)->nullable()->collation('utf8mb4_bin');
            $table->enum('application_status', ['new','evaluation' ,'pending', 'approved', 'ongoing', 'completed', 'rejected'])->default('new');
            $table->dateTime('Evaluation_date')->nullable();
            $table->string('Evaluation_status', 15)->nullable();
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Project_id')->references('Project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_info');
    }
};
