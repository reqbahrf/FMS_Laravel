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
        Schema::table('application_info', function (Blueprint $table) {
            $table->decimal('requested_fund_amount', 10, 2)->nullable()->after('application_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_info', function (Blueprint $table) {
            $table->dropColumn('requested_fund_amount');
        });
    }
};
