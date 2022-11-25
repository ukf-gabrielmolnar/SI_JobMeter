<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Study_program;
use Database\Seeders\StudyProgramSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Job::class;

    public function definition()
    {
        return [
            'job_type'=>$this->faker->jobTitle,
            'companies_id'=> $this->faker->numberBetween(1,5),
            'study_programs_id'=> $this->faker->numberBetween(1,5),
        ];
    }
}
