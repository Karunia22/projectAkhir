<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("users")->insert([
            [
                'name'=> 'karunia',
                'email'=> 'karunia@gmail.com',
                'no_telepon'=> '9898000898',
                'password'=> bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name'=> 'daud',
                'email'=> 'daud@gmail.com',
                'no_telepon'=> '9898000891',
                'password'=> bcrypt('12345678'),
                'role' => 'penjual',
            ],
        ]);
    }
}
