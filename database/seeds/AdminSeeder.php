<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('myagenda_user')->insert([
            'myagenda_user_nama' => 'Admin',
            'myagenda_user_email' => 'admin@example.com',
            'myagenda_user_password' => Hash::make('password123'), 
            'myagenda_user_role' => 'admin', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
