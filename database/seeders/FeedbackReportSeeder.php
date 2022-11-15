<?php

namespace Database\Seeders;

use App\Models\Feedback_Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedback_Report::factory()
            ->count(15)
            ->create();
    }
}
