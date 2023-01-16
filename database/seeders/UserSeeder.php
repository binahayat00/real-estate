<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'alex',
            'email' => 'alex@f.c',
            'password' => Hash::make(123123),
        ]);

        User::create([
            'name' => 'alex2',
            'email' => 'alex2@f.c',
            'password' => Hash::make(123123),
        ]);

        User::create([
            'name' => 'alex3',
            'email' => 'alex3@f.c',
            'password' => Hash::make(123123),
        ]);

        User::create([
            'name' => 'alex4',
            'email' => 'alex4@f.c',
            'password' => Hash::make(123123),
        ]);

        User::create([
            'name' => 'alex5',
            'email' => 'alex5@f.c',
            'password' => Hash::make(123123),
        ]);
    }
}
