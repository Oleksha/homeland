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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // Периоды
            $table->date('budget_period')
                ->comment('Сценарий бюджета (YYYY-MM-01)');

            $table->date('expense_month')
                ->comment('Месяц расхода (YYYY-MM-01)');

            $table->date('payment_month')
                ->comment('Месяц оплаты (YYYY-MM-01)');

            // Номер операции
            $table->string('budget_number')
                ->comment('Номер бюджетной операции');

            // Суммы
            $table->decimal('amount', 15, 2)
                ->comment('Сумма с НДС');

            // Связи
            $table->foreignId('vat_id')
                ->constrained('vats')
                ->restrictOnDelete();

            $table->foreignId('expense_item_id')
                ->constrained('expense_items')
                ->restrictOnDelete();

            // Статус
            $table->string('status', 32)
                ->comment('Статус бюджетной операции');

            // Описание
            $table->text('description')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Индексы
            $table->index('budget_period');
            $table->index('expense_month');
            $table->index('payment_month');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
