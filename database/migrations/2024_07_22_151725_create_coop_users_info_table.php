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
        Schema::create('coop_users_info', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 64)->unique();
            $table->string('prefix', 15)->nullable();
            $table->string('f_name', 30);
            $table->string('mid_name', 30)->nullable();
            $table->string('l_name', 30);
            $table->string('suffix', 15)->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('designation', 30)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('landline', 20)->nullable();
            $table->foreign('user_name')->references('user_name')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coop_users_info');
    }
};
