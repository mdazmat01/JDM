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
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Shohel Rana',
                'role' => 'admin',
                'email' => 'shohelbcc@gmail.com',
                'password' => Hash::make('11111111'),
            ],
            [
                'name' => 'Jakir',
                'role' => 'user',
                'email' => 'jakir@gmail.com',
                'password' => Hash::make('11111111'),
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
