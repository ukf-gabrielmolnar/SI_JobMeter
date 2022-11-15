<?php

namespace Database\Seeders;

use App\Models\Study_program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Study_program::factory()
            ->count(15)
            ->create();
    }
}
