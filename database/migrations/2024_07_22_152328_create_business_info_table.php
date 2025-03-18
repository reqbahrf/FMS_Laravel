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
        Schema::create('business_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_info_id')->unsigned();
            $table->string('firm_name', 40);
            $table->enum('enterprise_type', ['Sole Proprietorship', 'Partnership', 'Corporation (Profit)', 'Corporation (Non-profit)']);
            $table->enum('enterprise_level', ['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise', 'Large Enterprise']);
            $table->string('zip_code', 10);
            $table->string('landMark', 64);
            $table->string('barangay', 64);
            $table->string('city', 64);
            $table->string('province', 64);
            $table->string('region', 64);
            $table->json('Export_Mkt_Outlet')->nullable();
            $table->json('Local_Mkt_Outlet')->nullable();
            $table->foreign('user_info_id')->references('id')->on('coop_users_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_info');
    }
};
