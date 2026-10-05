<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_hi')->nullable();
            $table->string('category')->default('general'); // general, circular, office_order, notification, public_notice
            $table->string('slug')->unique();
            $table->boolean('is_new')->default(true);
            $table->string('file_path')->nullable();
            $table->string('status')->default('draft'); // draft, pending_review, published, rejected, archived
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
