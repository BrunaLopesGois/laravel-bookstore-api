<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::insert([
        //     'name' => 'John Doe',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('admin'),
        //     'profile' => 'admin',
        // ]);

        User::insert([
            'name' => 'Mary Jean',
            'email' => 'client@example.com',
            'password' => Hash::make('client'),
            'profile' => 'client',
        ]);
    }
}
