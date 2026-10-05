<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_hi')->nullable();
            $table->date('date');
            $table->string('location_en')->nullable();
            $table->string('location_hi')->nullable();
            $table->string('type')->default('departmental'); // departmental, review, public, special
            $table->string('slug')->unique();
            $table->string('meeting_status')->default('scheduled'); // scheduled, completed, cancelled
            $table->text('agenda_en')->nullable();
            $table->text('agenda_hi')->nullable();
            $table->text('minutes_en')->nullable();
            $table->text('minutes_hi')->nullable();
            $table->text('resolutions_en')->nullable();
            $table->text('resolutions_hi')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['date', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
