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
        Schema::create('payment_request_budget', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payment_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('budget_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('amount', 15);

            $table->foreignId('vat_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->timestamps();

            $table->unique(
                ['payment_request_id', 'budget_id'],
                'pr_budget_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_request_budget');
    }
};
