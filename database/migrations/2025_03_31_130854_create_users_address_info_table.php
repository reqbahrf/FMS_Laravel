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
        Schema::create('users_address_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_info_id')->unsigned()->unique();
            $table->string('zip_code', 10)->nullable();
            $table->string('landMark', 64)->nullable();
            $table->string('barangay', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('province', 64)->nullable();
            $table->string('region', 64)->nullable();
            $table->timestamps();

            $table->foreign('user_info_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_address_info');
    }
};
