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
        $users = [
            [
                'role_id'=> '1',
                'name'=> 'Admin',
                'email'=>'admin@admin.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
            ],
            [
                'role_id'=> '2',
                'name'=> 'User',
                'email'=>'user@user.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
            ]
        ];

        User::insert($users);

    }
}
