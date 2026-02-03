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
        Schema::create('payment_authorizations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contractor_id')->constrained();
            $table->foreignId('expense_item_id')->constrained();

            $table->string('number', 50);

            $table->date('date_start');
            $table->date('date_end');

            $table->unsignedInteger('delay')->default(0);

            $table->decimal('amount', 15, 2);

            $table->timestamps();

            $table->index(['contractor_id', 'expense_item_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_authorizations');
    }
};
