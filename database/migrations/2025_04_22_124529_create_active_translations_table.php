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
        Schema::create('active_translations', function (Blueprint $table) {
            $table->id();

            // Link to translator (translator_id = user_id from translators table)
            $table->unsignedBigInteger('translator_id');
            $table->foreign('translator_id')->references('user_id')->on('translators')->onDelete('cascade');

            // Link to the translation being worked on
            $table->unsignedBigInteger('translation_id');
            $table->foreign('translation_id')->references('id')->on('translations')->onDelete('cascade');

            // When the lock was created or last refreshed
            $table->timestamp('locked_at')->useCurrent();

            $table->timestamps();

            // Make sure the same translator can't have the same lock twice
            $table->unique(['translator_id', 'translation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_translations');
    }
};
