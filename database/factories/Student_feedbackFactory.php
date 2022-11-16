<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student_feedback>
 */
class Student_feedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject'=>$this->faker->name,
            'text'=>$this->faker->name,
            'contracts_id'=> Contract::factory(),
        ];
    }
}
