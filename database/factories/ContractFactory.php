<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Contract;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Contract::class;

    public function definition()
    {
        return [
            'users_id'=> User::factory(),
            'jobs_id'=> Job::factory(),

            'od'=>$this->faker->date,
            'do'=>$this->faker->date,
            'approved'=>$this->faker->boolean,
            'closed'=>$this->faker->boolean,
        ];
    }
}
