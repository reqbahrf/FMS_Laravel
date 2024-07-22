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
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->integer('evaluated_by_id')->unsigned();
            $table->integer('handled_by_id')->unsigned()->default(1);
            $table->string('project_title', 255)->default('still in evaluation');
            $table->timestamp('date_approved')->useCurrent();
            $table->decimal('fund_amount', 10, 2)->default(0.00);
            $table->decimal('refunded_amount', 10, 2)->default(0.00);
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
