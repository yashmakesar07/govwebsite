<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('documentable_type')->nullable();
            $table->unsignedBigInteger('documentable_id')->nullable();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->string('type')->default('document'); // tender_notice, specification, boq, agenda, minutes, act, circular
            $table->string('language')->default('english');
            $table->string('file_path');
            $table->integer('file_size')->default(0); // bytes
            $table->string('mime_type')->nullable();
            $table->string('status')->default('published');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['documentable_type', 'documentable_id']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
