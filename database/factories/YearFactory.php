<?php

namespace Database\Factories;

use App\Models\Study_program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Year>
 */
class YearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'year'=>$this->faker->year,
            'study_programs_id'=>Study_program::factory(),
        ];
    }
}
