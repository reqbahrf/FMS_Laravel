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
        Schema::create('assets', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->unsigned();
            $table->decimal('building_value', 10, 2);
            $table->decimal('equipment_value', 10, 2);
            $table->decimal('working_capital', 10, 2);
            $table->foreign('id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
