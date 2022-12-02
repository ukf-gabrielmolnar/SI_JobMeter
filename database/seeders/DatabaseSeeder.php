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
        $spb = [
            'Aplikovaná ekológia a environmentalistika',
            'Aplikovaná informatika',
            'Biológia',
            'Fyzika',
            'Geografia v regionálnom rozvoji',
            'Matematicko-štatistické a informačné metódy v ekonómii a finančníctve',
            'Učiteľstvo biológie v kombinácii',
            'Učiteľstvo chémie v kombinácii',
            'Učiteľstvo ekológie v kombinácii',
            'Učiteľstvo fyziky v kombinácii',
            'Učiteľstvo geografie v kombinácii',
            'Učiteľstvo informatiky v kombinácii',
            'Učiteľstvo matematiky v kombinácii',
            'Učiteľstvo odborných ekonomických predmetov v kombinácii'];
        $yb = ['1. Bc.', '2. Bc.', '3. Bc.'];
        for ($i = 0; $i < sizeof($spb); $i++){
            DB::table('study_programs')->insert([
                'study_program' => $spb[$i],
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            for ($k = 0; $k < sizeof($yb); $k++){
                DB::table('years')->insert([
                    'year' => $yb[$k],
                    'study_programs_id' => Study_program::find($i+1)->id,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
        }

        $spm = [
            'Aplikovaná informatika',
            'Biológia',
            'Environmentalistika v krajinnom plánovaní a praxi',
            'Fyzika materiálov',
            'Geografia v regionálnom rozvoji',
            'Učiteľstvo biológie v kombinácii',
            'Učiteľstvo chémie v kombinácii',
            'Učiteľstvo ekológie v kombinácii',
            'Učiteľstvo fyziky v kombinácii',
            'Učiteľstvo geografie v kombinácii',
            'Učiteľstvo informatiky v kombinácii',
            'Učiteľstvo matematiky v kombinácii',
            'Učiteľstvo odborných ekonomických predmetov v kombinácii'];
        $ym = ['1. Mgr.', '2. Mgr.'];
        for ($i = 0; $i < sizeof($spm); $i++){
            DB::table('study_programs')->insert([
                'study_program' => $spm[$i],
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            for ($k = 0; $k < sizeof($ym); $k++){
                DB::table('years')->insert([
                    'year' => $ym[$k],
                    'study_programs_id' => Study_program::find($i+1)->id,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
        }

        $spd = [
            'Aplikovaná informatika',
            'Environmentalistika',
            'Fyzika materiálov',
            'Molekulárna biológia',
            'Teória vyučovania chémie',
            'Teória vyučovania matematiky',];
        $yd = ['1. Dr.', '2. Dr.'];
        for ($i = 0; $i < sizeof($spd); $i++){
            DB::table('study_programs')->insert([
                'study_program' => $spd[$i],
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            for ($k = 0; $k < sizeof($yd); $k++){
                DB::table('years')->insert([
                    'year' => $yd[$k],
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
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'mng',
            'lastname' => 'mng',
            'email' => 'mng@mng.com',
            'password' => bcrypt('123456789'),
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'ppp',
            'lastname' => 'ppp',
            'email' => 'ppp@ppp.com',
            'password' => bcrypt('123456789'),
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'student',
            'lastname' => 'student',
            'email' => 'student@student.com',
            'password' => bcrypt('123456789'),
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'ceo',
            'lastname' => 'ceo',
            'email' => 'ceo@ceo.com',
            'password' => bcrypt('123456789'),
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        DB::table('user_role')->insert([
            'user_id' => '2',
            'role_id' => '2',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('user_role')->insert([
            'user_id' => '3',
            'role_id' => '3',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('user_role')->insert([
            'user_id' => '4',
            'role_id' => '4',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('user_role')->insert([
            'user_id' => '5',
            'role_id' => '5',
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        $this->call([
            CompanySeeder::class,
            ContactSeeder::class,
            JobSeeder::class,
            //ContractSeeder::class,
            //FeedbackReportSeeder::class,
            //RecordSeeder::class,
            //StudentFeedbackSeeder::class,
            //StudyProgramSeeder::class,
            //UserSeeder::class,
            //YearSeeder::class,
        ]);
    }
}
