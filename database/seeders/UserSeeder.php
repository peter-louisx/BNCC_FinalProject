<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin account
        User::create([
            'name' => 'Peter Louis Anderson',
            'email' => 'peterlouisx@gmail.com',
            'password' => Hash::make('admin123'),
            'phone' => '081234567890',
            'is_admin' => 1,
        ]);

        //User 1
        User::create([
            'name' => 'Louis Anderling',
            'email' => 'peterad@gmail.com',
            'password' => Hash::make('user123'),
            'phone' => '081234567891',
        ]);

        //User 2
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('user2123'),
            'phone' => '081234567892',
        ]);



    }
}