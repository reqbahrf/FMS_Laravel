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
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('business_id')->unsigned();
            $table->string('file_name', 32);
            $table->string('file_link', 500);
            $table->string('file_type', 20);
            $table->boolean('can_edit')->default(false);
            $table->enum('remarks', ['Approved', 'Rejected', 'Pending'])->default('Pending');
            $table->string('remark_comments', 100)->nullable();
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
