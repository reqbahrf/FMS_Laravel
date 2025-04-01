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
        Schema::table('business_info', function (Blueprint $table) {
            $table->string('year_established', 4)->nullable();
            $table->string('permit_type', 64)->nullable();
            $table->string('business_permit_no', 64)->nullable();
            $table->string('permit_year_registered', 4)->nullable();
            $table->string('registration_type', 64)->nullable();
            $table->string('enterprise_registration_no', 64)->nullable();
            $table->string('enterprise_year_registered', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_info', function (Blueprint $table) {
            //
        });
    }
};
