<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contract;
use App\Models\Record;
use App\Models\Study_program;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
//        DB::table('users')->insert([
//            'firstname' => 'admin',
//            'lastname' => 'admin',
//            'email' => 'admin@admin.com',
//            'password' => 'admin1234',
//        ]);
        $this->call([
            //CompanySeeder::class,
            //ContactSeeder::class,
            ContractSeeder::class,
            //FeedbackReportSeeder::class,
            //JobSeeder::class,
            RecordSeeder::class,
            //StudentFeedbackSeeder::class,
            //StudyProgramSeeder::class,
            UserSeeder::class,
        ]);
    }
}
