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
            $table->string('sector', 64)->nullable()->after('enterprise_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->dropColumn('sector');
        });
    }
};
