<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contract;
use App\Models\Record;
use App\Models\Study_program;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            ContactSeeder::class,
            ContractSeeder::class,
            //FeedbackReport::class,
            JobSeeder::class,
            //RecordSeeder::class,
            //StudentFeedbackSeeder::class,
            //StudyProgramSeeder::class,
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
