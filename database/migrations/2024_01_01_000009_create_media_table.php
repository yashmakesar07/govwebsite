<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->text('caption_en')->nullable();
            $table->text('caption_hi')->nullable();
            $table->string('category')->default('general'); // events, meetings, infrastructure, inspections, community
            $table->string('file_path');
            $table->string('thumbnail_path')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->default('published');
            $table->timestamps();

            $table->index('category');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
