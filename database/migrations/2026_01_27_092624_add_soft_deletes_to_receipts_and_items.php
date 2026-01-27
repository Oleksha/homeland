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
        Schema::table('receipts', function ($table) {
            $table->softDeletes();
        });

        Schema::table('receipt_items', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receipts', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('receipt_items', function ($table) {
            $table->dropSoftDeletes();
        });
    }
};
