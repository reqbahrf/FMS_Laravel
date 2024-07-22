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
        Schema::create('org_users_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 64);
            $table->string('full_name', 255);
            $table->date('birthdate');
            $table->string('access_to', 255);
            $table->foreign('user_name')->references('user_name')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_users_info');
    }
};
