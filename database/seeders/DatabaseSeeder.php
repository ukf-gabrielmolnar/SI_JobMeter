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


        DB::table('companies')->insert([
            'name' => 'Samsung',
            'address' => '1332, Galatna',
            'approved' => '1',
            'updated_at' => now(),
            'created_at' => now(),
        ]);

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
            'years_id' => '1',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'samsung',
            'lastname' => 'ceo',
            'email' => 'samsungceo@ceo.com',
            'password' => bcrypt('123456789'),
            'companies_id' => '1',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'dev',
            'lastname' => 'dev',
            'email' => 'dev@dev.com',
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
        DB::table('user_role')->insert([
            'user_id' => '6',
            'role_id' => '6',
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        DB::table('jobs')->insert([
            'job_type' => 'Wholesale Buyer',
            'companies_id' => '1',
            'study_programs_id' => '1',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('contacts')->insert([
            'firstname' => 'Test',
            'lastname' => 'Contact',
            'email' => 'testcontact@gmail.com',
            'tel' => '+421 923 456 798',
            'companies_id' => '1',
            'approved' => '1',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('contracts')->insert([
            'users_id' => '4',
            'jobs_id' => '1',
            'ppp_id' => '3',
            'contacts_id' => '1',
            'od' => '2022-12-01',
            'do' => '2023-12-01',
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
