<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Shivcharan Kumar",
            "email" => "shivcharan@gmail.com",
            "password" => Hash::make(12345678),
            // "password" => 12345678,
            "is_admin" => 1
        ]);
    }
}
