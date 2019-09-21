<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'test@test.com',
                'password' => bcrypt('test'),
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ],
            [
                'email' => 'test1@test.com',
                'password' => bcrypt('test'),
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
