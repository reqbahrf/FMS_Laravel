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
            $table->boolean('is_assisted')->default(false)->after('Evaluation_status');
            $table->bigInteger('assisted_by')->unsigned()->nullable()->after('is_assisted');

            $table->foreign('assisted_by')->references('id')->on('org_users_info')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_info', function (Blueprint $table) {
            $table->dropColumn('is_assisted');
            $table->dropColumn('assisted_by');
        });
    }
};
