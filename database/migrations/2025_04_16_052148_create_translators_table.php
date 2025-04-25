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
        Schema::create('translators', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_accepted')->default(false);
            $table->string('cv_path')->nullable();
            $table->text('desc')->nullable();
            $table->string('level')->default(1);
            $table->integer('exp')->default(0);

            $table->primary(['user_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translators');
    }
};
