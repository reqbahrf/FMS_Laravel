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
        Schema::create('personnel', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->integer('male_direct_re');
            $table->integer('female_direct_re');
            $table->integer('male_direct_part');
            $table->integer('female_direct_part');
            $table->integer('male_indirect_re');
            $table->integer('female_indirect_re');
            $table->integer('male_indirect_part');
            $table->integer('female_indirect_part');
            $table->foreign('id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
};
