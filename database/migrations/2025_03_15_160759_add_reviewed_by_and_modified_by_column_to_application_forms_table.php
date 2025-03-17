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
        Schema::table('application_forms', function (Blueprint $table) {
            // First add the columns
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('status');
            $table->dateTime('reviewed_at')->nullable()->after('reviewed_by');
            $table->unsignedBigInteger('modified_by')->nullable()->after('reviewed_by');
            $table->dateTime('modified_at')->nullable()->after('modified_by');

            // Then add the foreign key constraints
            $table->foreign('reviewed_by')
                ->references('id')
                ->on('org_users_info')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('modified_by')
                ->references('id')
                ->on('org_users_info')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_forms', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['reviewed_by']);
            $table->dropForeign(['modified_by']);
            // Then drop columns
            $table->dropColumn('reviewed_by');
            $table->dropColumn('modified_by');
            $table->dropColumn('reviewed_at');
            $table->dropColumn('modified_at');
        });
    }
};
