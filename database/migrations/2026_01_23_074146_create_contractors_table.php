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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->nullable()->unique();

            $table->foreignId('type_id')
                ->constrained('contractor_types')
                ->cascadeOnUpdate();

            $table->boolean('is_supplier')->default(false);

            $table->string('inn', 12)->nullable();
            $table->string('kpp', 9)->nullable();

            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->unsignedInteger('delay')->default(0);

            $table->foreignId('vat_id')
                ->nullable()
                ->constrained('vats')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
