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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->string('number');

            $table->tinyInteger('type'); // enum
            $table->foreignId('contractor_id')->constrained()->cascadeOnDelete();

            $table->string('document_number')->nullable();
            $table->date('document_date')->nullable();

            $table->text('note')->nullable();

            $table->boolean('status')->default(true);

            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('total_vat', 15, 2)->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
