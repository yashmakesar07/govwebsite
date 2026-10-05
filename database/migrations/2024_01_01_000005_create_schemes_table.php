<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_hi')->nullable();
            $table->text('objectives_en')->nullable();
            $table->text('objectives_hi')->nullable();
            $table->text('eligibility_en')->nullable();
            $table->text('eligibility_hi')->nullable();
            $table->string('slug')->unique();
            $table->integer('progress_percentage')->default(0);
            $table->decimal('financial_allocation', 15, 2)->nullable();
            $table->integer('beneficiaries_count')->default(0);
            $table->string('scheme_status')->default('active'); // active, upcoming, completed, suspended
            $table->string('status')->default('draft');
            $table->string('image_path')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
