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
        Schema::create('business_address_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('business_info_id')->unsigned();
            $table->string('office_landmark', 64);
            $table->string('office_barangay', 64);
            $table->string('office_city', 64);
            $table->string('office_province', 64);
            $table->string('office_region', 64);
            $table->string('office_zip_code', 10);
            $table->string('factory_landmark', 64);
            $table->string('factory_barangay', 64);
            $table->string('factory_city', 64);
            $table->string('factory_province', 64);
            $table->string('factory_region', 64);
            $table->string('factory_zip_code', 10);
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_address_info');
    }
};
