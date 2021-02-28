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
            'username' => '960927',
            'email' => 'safiati@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => '990125',
            'email' => 'raihan@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => '001110',
            'email' => 'azhar@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => '021103',
            'email' => 'izham@tisa.my',
            'password' =>  Hash::make('password')
        ])->assignRole('user');

        User::create([
            'username' => '041206',
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
