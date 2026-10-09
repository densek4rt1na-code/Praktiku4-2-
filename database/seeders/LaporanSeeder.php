<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kecamatan = [
            'Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya',
            'Banjaran', 'Pameungpeuk', 'Katapang', 'Cileunyi', 'Cicalengka',
        ];

        // 3 data pertama dipaksa mewakili tiap status agar variasi pasti muncul:
        // Waspada (<30), Siaga (30-70), Awas (>70)
        $tinggiPaksa = [
            $faker->numberBetween(10, 29),
            $faker->numberBetween(30, 70),
            $faker->numberBetween(71, 150),
        ];

        for ($i = 0; $i < 20; $i++) {
            Laporan::create([
                'nama_pelapor'     => $faker->name(),
                'lokasi'           => $faker->randomElement($kecamatan),
                'tinggi_genangan'  => $tinggiPaksa[$i] ?? $faker->numberBetween(10, 150),
                'tanggal_kejadian' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
