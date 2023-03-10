<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
        [
            'name' => 'admin',
            'description' => 'Has full control of the application'
        ],
    ]);

        DB::table('users')->insert([
            'fullname' => 'Jaspher Xyke Cortez',
            'email' => 'jasxyke23.jxc@gmail.com',
            'password' => Hash::make('password'),//password
            'role_id' => 1,
        ]);
    }
}
