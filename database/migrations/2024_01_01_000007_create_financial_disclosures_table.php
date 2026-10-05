<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_disclosures', function (Blueprint $table) {
            $table->id();
            $table->string('financial_year'); // e.g., 2025-26
            $table->string('quarter'); // Q1, Q2, Q3, Q4
            $table->decimal('fund_receipts', 15, 2)->default(0);
            $table->decimal('expenditure', 15, 2)->default(0);
            $table->decimal('project_allocation', 15, 2)->default(0);
            $table->string('project_category')->default('general');
            $table->text('remarks_en')->nullable();
            $table->text('remarks_hi')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['financial_year', 'quarter']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_disclosures');
    }
};
