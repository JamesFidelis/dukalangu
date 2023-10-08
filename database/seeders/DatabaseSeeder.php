<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);


        DB::table('users')->insert([
            'name' => 'James Kanga',
            'username' => 'JamesKanga',
            'email' => 'jameskanga'.'@gmail.com',
            'isAdmin' => 1,
            'tin_number' => 1781551,
            'phone_number' => '255768104101',
            'password' => Hash::make('password'),
        ]);
       DB::table('users')->insert([
            'name' => 'Michael Momo',
            'username' => 'MichaelMomo',
            'email' => 'michael'.'@gmail.com',
            'isAdmin' => 1,
            'tin_number' => 6918651,
            'phone_number' => '255761234567',
            'password' => Hash::make('password'),
        ]);

    }
}
