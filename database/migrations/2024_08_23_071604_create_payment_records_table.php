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
        Schema::create('payment_records', function (Blueprint $table) {
            $table->id();
            $table->char('Project_id', 32)->collation('utf8mb4_bin');
            $table->string('reference_number', 64)->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_status', ['Due', 'Pending', 'Paid', 'Overdue'])->default('Pending');
            $table->string('payment_method');
            $table->timestamps();
            $table->foreign('Project_id')->references('Project_id')->on('project_info')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_records');
    }
};
