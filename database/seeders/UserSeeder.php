<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
/*        User::factory()
            ->count(6)
            ->create();*/

        $users = [
            [
                'name' => 'James Bond',
                'email' => 'bond',
            ],
            [
                'name' => 'John Smith',
                'email' => 'john',
            ],
            [
                'name' => 'Barbara Roo',
                'email' => 'barbara',
            ],
            [
                'name' => 'Erica Moen',
                'email' => 'erica',
            ],
            [
                'name' => 'Kevin Sipes',
                'email' => 'kevin',
            ],
            [
                'name' => 'Bill Gates',
                'email' => 'bill',
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'] . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
