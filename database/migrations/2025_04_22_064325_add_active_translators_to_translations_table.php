<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->unsignedInteger('active_translators')->default(0)->after('value');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropColumn('active_translators');
        });
    }
};
