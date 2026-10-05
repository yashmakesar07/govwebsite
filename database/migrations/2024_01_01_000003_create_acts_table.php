<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_hi')->nullable();
            $table->string('type')->default('act'); // act, rule, guideline, regulation, circular
            $table->integer('year');
            $table->string('language')->default('english'); // english, hindi, bilingual
            $table->string('category')->default('general');
            $table->string('slug')->unique();
            $table->string('file_path')->nullable();
            $table->integer('file_size')->nullable(); // bytes
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['type', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
