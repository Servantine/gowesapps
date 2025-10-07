<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            // Membuat user dengan role 'admin'
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('adminpassword'),  // Pastikan password di-hash
                'role' => 'admin',
            ]);
            
            // Jika ingin menambahkan user dengan role 'user'
            User::create([
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'password' => Hash::make('userpassword'),  // Pastikan password di-hash
                'role' => 'user',
            ]);
        }
}
