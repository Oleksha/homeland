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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();

            $table->date('date');                     // дата заявки
            $table->string('number')->unique();       // номер заявки

            $table->decimal('amount', 15); // сумма заявки
            $table->foreignId('vat_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('contractor_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->date('date_pay')->nullable();     // дата оплаты

            $table->string('status')->default('unpaid');

            $table->timestamps();
            $table->softDeletes();

            $table->index('date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_requests');
    }
};
