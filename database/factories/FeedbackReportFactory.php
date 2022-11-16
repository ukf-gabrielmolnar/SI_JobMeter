<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedbackReport>
 */
class FeedbackReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject'=>$this->faker->words,
            'text'=>$this->faker->text,
            'contracts_id'=> Contract::factory(),
            'users_id'=> User::factory(),
        ];
    }
}
