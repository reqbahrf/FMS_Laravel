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
        Schema::create('temporary_files', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->bigInteger('owner_id')->nullable()->unsigned();
            $table->string('unique_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type');
            $table->bigInteger('file_size');
            $table->timestamps();
            $table->index('unique_id');

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_files');
    }
};
