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
                'password'=> bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name'=> 'daud',
                'email'=> 'daud@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'penjual',
            ],
        ]);
    }
}
