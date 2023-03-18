<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Usuário Onfly',
            'email' => 'gabriel@onfly.com.br',
            'password' => bcrypt('password')
        ]);

        User::factory(10)->create();
        Expense::factory(50)->create();
    }
}
