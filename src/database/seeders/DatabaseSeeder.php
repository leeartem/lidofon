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

        User::factory()->create([
            'name' => 'Артем',
            'middle_name' => 'Георгиевич',
            'last_name' => 'Ли',
            'email' => 'user@user.com',
            'password' => 'user',
        ]);

        User::factory(10)->create([
        ]);
    }
}
