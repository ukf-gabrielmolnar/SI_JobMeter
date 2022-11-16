<?php

namespace Database\Seeders;

use App\Models\Student_feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student_feedback::factory()
            ->count(15)
            ->create();
    }
}
