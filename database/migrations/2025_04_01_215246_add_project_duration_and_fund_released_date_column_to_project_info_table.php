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
        Schema::table('project_info', function (Blueprint $table) {
            $table->integer('project_duration')->nullable()->max(6)->after('project_title');
            $table->date('fund_released_date')->nullable()->after('project_duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_info', function (Blueprint $table) {
            $table->dropColumn('project_duration');
            $table->dropColumn('fund_released_date');
        });
    }
};
