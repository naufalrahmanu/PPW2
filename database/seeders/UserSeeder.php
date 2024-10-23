<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',  // Nama pengguna
            'email' => 'johndoe@example.com',  // Email pengguna
            'password' => Hash::make('password123'),  // Password yang di-hash
        ]);
    }
}