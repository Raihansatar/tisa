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

        User::create([
            'username' => 'safiati',
            'email' => 'safiati@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'raihan',
            'email' => 'raihan@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'azhar',
            'email' => 'azhar@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'izham',
            'email' => 'izham@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'suhada',
            'email' => 'suhada@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'shahiera',
            'email' => 'shahiera@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => 'haziq',
            'email' => 'haziq@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        

    }
}
