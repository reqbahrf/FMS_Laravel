<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ongoing_project_quarterly_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ongoing_project_id')->unsigned();
            $table->string('quarter', 64);
            $table->longText('report_file')->nullable();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('date_Completed')->nullable();
            $table->string('can_edit', 30);
            $table->foreign('ongoing_project_id')->references('id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongoing_project_quarterly_report');
    }
};
