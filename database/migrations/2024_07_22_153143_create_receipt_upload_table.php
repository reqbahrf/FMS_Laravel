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
            $table->integer('ongoing_project_id')->unsigned();
            $table->string('receipt_name', 30);
            // $table->binary('receipt_file');
            $table->string('can_edit', 30);
            $table->string('remark', 30)->nullable();
            $table->string('comment', 255)->nullable();
            $table->timestamps();
            $table->foreign('ongoing_project_id')->references('id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::statement("ALTER TABLE `receipt_upload` ADD receipt_file MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_upload');
    }
};
