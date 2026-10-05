<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('tender_number')->unique();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_hi')->nullable();
            $table->string('department')->default('Department of Public Infrastructure');
            $table->string('category')->default('general'); // works, goods, services, consultancy
            $table->string('slug')->unique();
            $table->date('published_date');
            $table->date('closing_date');
            $table->string('tender_status')->default('active'); // active, upcoming, closing_soon, closed
            $table->string('status')->default('draft'); // draft, pending_review, published, rejected, archived
            $table->decimal('estimated_value', 15, 2)->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('tender_status');
            $table->index(['published_date', 'closing_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
