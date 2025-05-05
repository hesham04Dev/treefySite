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
        Schema::create('language_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('translator_id')->constrained('translators','user_id')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->text('reason');
            $table->string('file_path');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_requests');
    }
};
