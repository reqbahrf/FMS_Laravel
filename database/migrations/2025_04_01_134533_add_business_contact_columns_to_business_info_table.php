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
            $table->string('office_telephone', 64)->nullable()->after('enterprise_year_registered');
            $table->string('office_fax_no', 16)->nullable()->after('office_telephone');
            $table->string('office_email', 128)->nullable()->after('office_fax_no');
            $table->string('factory_telephone', 64)->nullable()->after('office_email');
            $table->string('factory_fax_no', 16)->nullable()->after('factory_telephone');
            $table->string('factory_email', 128)->nullable()->after('factory_fax_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->dropColumn('office_telephone');
            $table->dropColumn('office_fax_no');
            $table->dropColumn('office_email');
            $table->dropColumn('factory_telephone');
            $table->dropColumn('factory_fax_no');
            $table->dropColumn('factory_email');
        });
    }
};
