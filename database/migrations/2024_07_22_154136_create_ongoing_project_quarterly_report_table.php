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
            $table->id();
            $table->char('ongoing_project_id', 15)->collation('utf8mb4_bin');
            $table->char('quarter', 15);
            $table->longText('report_file')->nullable();
            $table->date('open_until')->nullable();
            $table->enum('report_status', ['open', 'closed'])->default('open');
            $table->timestamps();
            $table->foreign('ongoing_project_id')->references('project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
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
