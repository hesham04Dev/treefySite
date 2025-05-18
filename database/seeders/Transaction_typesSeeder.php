<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Transaction_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['value' => 'purchase'],
            ['value' => 'sell', ],
            ['value' => 'transfer',],
            ['value' => 'verify', ],
          
        ];

        DB::table('transaction_types')->insert($types);
    }
}
