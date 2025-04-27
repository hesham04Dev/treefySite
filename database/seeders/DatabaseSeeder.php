<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(LanguageSeeder::class);
        // User::factory()->create([
        //     'name' => 'Hisham Admin',
        //     'email' => 'hesham04.devl@example.com',
        // ]);
        User::create(["name" => "Hisham Admin", "email" => "hcody@gmail.com", "password" => bcrypt("102030zZ!"), ]);
        User::create(["name" => "user1", "email" => "user1@gmail.com", "password" => bcrypt("102030zZ!"), ]);
        User::create(["name" => "user2", "email" => "user2@gmail.com", "password" => bcrypt("102030zZ!"), ]);
        User::create(["name" => "t1", "email" => "trans1@gmail.com", "password" => bcrypt("102030zZ!"), ]);
        User::create(["name" => "t2", "email" => "trans2@gmail.com", "password" => bcrypt("102030zZ!"), ]);
        User::create(["name" => "t3", "email" => "trans3@gmail.com", "password" => bcrypt("102030zZ!"), ]);
    }
}
