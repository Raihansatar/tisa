<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'username' => 'tisa',
            'email' => 'tisa@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('admin');

    }
}
