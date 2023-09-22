<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->create();
        DB::table('users')->insert([
            'name' => 'James Kanga',
            'username' => 'JamesKanga',
            'email' => 'jameskanga'.'@gmail.com',
            'isAdmin' => 1,
            'phone_number' => '255768104101',
            'password' => Hash::make('password'),
        ]);
    }
}
