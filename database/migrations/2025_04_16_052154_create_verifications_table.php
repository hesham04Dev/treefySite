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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('translator_id')->constrained('translators',"user_id")->cascadeOnDelete();
            $table->foreignId('translation_id')->constrained('translations')->cascadeOnDelete();
            $table->boolean('is_correct');
            $table->boolean('is_selected')->default(false);
            $table->timestamps();
            $table->unique(['translator_id', 'translation_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
