<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
