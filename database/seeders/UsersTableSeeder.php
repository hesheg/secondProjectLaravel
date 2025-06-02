<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'qqq',
                'email' => 'qqq@mail.ru',
                'password' => Hash::make('qqqqqq')
            ],
            [
                'name' => 'www',
                'email' => 'www@mail.ru',
                'password' => Hash::make('wwwwww')
            ],
            [
                'name' => 'eee',
                'email' => 'eee@mail.ru',
                'password' => Hash::make('eeeeee')
            ]
        ]);
    }
}
