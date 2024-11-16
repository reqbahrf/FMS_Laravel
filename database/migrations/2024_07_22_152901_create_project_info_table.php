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
        Schema::create('project_info', function (Blueprint $table) {
            $table->char('Project_id', 15)->primary()->unique()->collation('utf8mb4_bin');
            $table->bigInteger('business_id')->unsigned();
            $table->bigInteger('evaluated_by_id')->unsigned()->nullable();
            $table->bigInteger('handled_by_id')->unsigned()->nullable();
            $table->string('project_title', 255)->default('still in evaluation');
            $table->string('project_ledger_link', 255)->nullable();
            $table->decimal('fund_amount', 10, 2)->default(0.00);
            $table->decimal('actual_amount_to_be_refund', 10, 2)->default(0.00);
            $table->decimal('refunded_amount', 10, 2)->default(0.00);
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluated_by_id')->references('id')->on('org_users_info')->onUpdate('cascade');
            $table->foreign('handled_by_id')->references('id')->on('org_users_info')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_info');
    }
};
