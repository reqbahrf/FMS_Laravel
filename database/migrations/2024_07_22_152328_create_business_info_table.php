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
            $table->increments('id');
            $table->integer('user_info_id')->unsigned();
            $table->string('firm_name', 40)->unique();
            $table->string('enterprise_type', 40);
            $table->string('enterprise_level', 30);
            $table->string('zip_code', 10);
            $table->string('landMark', 64);
            $table->string('barangay', 64);
            $table->string('city', 64);
            $table->string('province', 64);
            $table->string('region', 64);
            $table->string('Export_Mkt_Outlet', 255);
            $table->string('Local_Mkt_Outlet', 255);
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
