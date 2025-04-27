<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $languages = [
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'ar', 'name' => 'Arabic'],
            ['code' => 'ru', 'name' => 'Russian'],
            ['code' => 'pt', 'name' => 'Portuguese'],
            ['code' => 'ko', 'name' => 'Korean'],
            ['code' => 'tr', 'name' => 'Turkish'],
            ['code' => 'hi', 'name' => 'Hindi'],
            ['code' => 'bn', 'name' => 'Bengali'],
            ['code' => 'vi', 'name' => 'Vietnamese'],
            ['code' => 'pl', 'name' => 'Polish'],
            ['code' => 'uk', 'name' => 'Ukrainian'],
            ['code' => 'ro', 'name' => 'Romanian'],
            ['code' => 'nl', 'name' => 'Dutch'],
            ['code' => 'es', 'name' => 'Spanish'],
            ['code' => 'fr', 'name' => 'French'],
            ['code' => 'de', 'name' => 'German'],
            ['code' => 'it', 'name' => 'Italian'],
            ['code' => 'ja', 'name' => 'Japanese'],
            ['code' => 'zh', 'name' => 'Chinese'],
        ];

        DB::table('languages')->insert($languages);
    }
}


