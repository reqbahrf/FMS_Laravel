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
        Schema::create('receipt_upload', function (Blueprint $table) {
            $table->increments('id');
            $table->char('ongoing_project_id', 15)->unique()->collation('utf8mb4_bin');
            $table->string('receipt_name', 30);
            $table->string('receipt_description', 255);
            $table->string('receipt_file_link' , 500);
            $table->string('can_edit', 30);
            $table->string('remark', 30)->nullable();
            $table->string('comment', 255)->nullable();
            $table->timestamps();
            $table->foreign('ongoing_project_id')->references('project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_upload');
    }
};
