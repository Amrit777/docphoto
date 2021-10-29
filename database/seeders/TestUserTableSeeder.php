<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'yustian',
            'password' => 'test123123#',
            'is_active' => 'Y',
            'employee_id' => 'ID00001'
        ]);
    }
}
