<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
   
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        User::updateOrCreate(
            ['email' => 'admin@bpbd.bandungkab.go.id'],
            [
                'name' => 'Admin BPBD Kabupaten Bandung',
                'email' => 'admin@bpbd.bandungkab.go.id',
                'password' => Hash::make('admin123'),
            ]
        );


        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "petugas{$i}@bpbd.bandungkab.go.id"],
                [
                    'name' => $faker->name(),
                    'email' => "petugas{$i}@bpbd.bandungkab.go.id",
                    'password' => Hash::make('password123'),
                ]
            );
        }
    }
}
