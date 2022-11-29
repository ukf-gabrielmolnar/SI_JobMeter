<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contract;
use App\Models\Record;
use App\Models\Study_program;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $sp = ['fyzika','kecske','imre', 'ember','kellek'];
        $y = ['1. Bc.', '2. Bc.', '3. Bc.', '1. Mgr.', '2. Mrg.'];
        for ($i = 0; $i < sizeof($sp); $i++){
            DB::table('study_programs')->insert([
                'study_program' => $sp[$i],
                'updated_at' => now(),
                'created_at' => now(),
            ]);

            for ($k = 0; $k < sizeof($y); $k++){
                DB::table('years')->insert([
                    'year' => $y[$k],
                    'study_programs_id' => Study_program::find($i+1)->id,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
        }


       DB::table('users')->insert([
          'firstname' => 'admin',
           'lastname' => 'admin',
           'email' => 'admin@admin.com',
           'password' => bcrypt('admin1234'),
        ]);



        $this->call([
            CompanySeeder::class,
            ContactSeeder::class,
            //ContractSeeder::class,
            //FeedbackReportSeeder::class,
            //RecordSeeder::class,
            //StudentFeedbackSeeder::class,
            //StudyProgramSeeder::class,
            JobSeeder::class,
            //UserSeeder::class,
            //YearSeeder::class,
        ]);
    }
}
