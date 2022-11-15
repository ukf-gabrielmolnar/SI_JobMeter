<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname'=>$this->faker->firstName,
            'lastname'=>$this->faker->lastName,
            'e-mail'=>$this->faker->email,
            'tel'=>$this->faker->phoneNumber,
            'companies_id'=> Company::factory(),
        ];
    }
}

