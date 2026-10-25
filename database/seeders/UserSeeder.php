<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Factory::create('id_ID');

        User::query()->updateOrCreate(
            ['email' => 'admin@smartmeritim.id'],
            [
                'name' => 'Administrator Smart Meritim',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        for ($i = 1; $i <= 5; $i++) {
            User::query()->updateOrCreate(
                ['email' => 'petugas'.$i.'@smartmeritim.id'],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
