<?php

namespace Database\Seeders;

use App\Models\Cuaca;
use App\Models\FishPrice;
use App\Models\Kapal;
use App\Models\Monitoring;
use App\Models\Parking;
use App\Models\Tangkapan;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SmartMaritimSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $ports = ['Pelabuhan Tenau, Kupang', 'Pelabuhan Atapupu, Belu', 'Pelabuhan Waingapu, Sumba Timur', 'Pelabuhan Kalabahi, Alor'];
        $fishTypes = ['Tuna', 'Tongkol', 'Cakalang', 'Kembung', 'Lemuru', 'Kerapu', 'Kakap', 'Tenggiri'];
        $ships = [];

        for ($index = 1; $index <= 10; $index++) {
            $ships[] = Kapal::query()->create([
                'nama_kapal' => 'KM '.$faker->city().' '.str_pad((string) $index, 2, '0', STR_PAD_LEFT),
                'jenis_kapal' => $faker->randomElement(['Penangkap Ikan', 'Pengangkut Ikan', 'Kapal Motor']),
                'nama_kapten' => $faker->name(),
                'status' => $faker->randomElement(['Berlayar', 'Bersandar', 'Maintenance']),
            ]);
        }

        foreach ($ships as $ship) {
            Tangkapan::query()->create([
                'kapal_id' => $ship->id,
                'jenis_ikan' => $faker->randomElement($fishTypes),
                'berat' => $faker->numberBetween(80, 1500),
                'tanggal_tangkap' => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'lokasi_tangkap' => $faker->randomElement($ports),
            ]);

            Monitoring::query()->create([
                'kapal_id' => $ship->id,
                'lokasi' => $faker->address(),
                'status_monitoring' => $faker->randomElement(['Aman', 'Waspada', 'Darurat']),
                'waktu_monitoring' => $faker->dateTimeBetween('-2 days', 'now'),
            ]);

            $waktuMasuk = $faker->dateTimeBetween('-14 days', 'now');
            Parking::query()->create([
                'kapal_id' => $ship->id,
                'lokasi_parkir' => $faker->randomElement($ports),
                'waktu_masuk' => $waktuMasuk,
                'waktu_keluar' => $faker->boolean(35) ? $faker->dateTimeBetween($waktuMasuk, 'now') : null,
                'status' => $faker->randomElement(['Parkir', 'Selesai']),
                'biaya' => $faker->numberBetween(0, 1500000),
            ]);
        }

        for ($index = 0; $index < 10; $index++) {
            FishPrice::query()->create([
                'jenis_ikan' => $faker->randomElement($fishTypes),
                'harga_per_kg' => $faker->numberBetween(18000, 150000),
                'lokasi_pasar' => $faker->randomElement($ports),
                'tanggal_update' => $faker->dateTimeBetween('-14 days', 'now')->format('Y-m-d'),
            ]);

            Cuaca::query()->create([
                'suhu' => $faker->randomFloat(2, 25, 34),
                'kondisi' => $faker->randomElement(['Cerah', 'Cerah Berawan', 'Berawan', 'Hujan Ringan']),
                'kecepatan_angin' => $faker->numberBetween(2, 35),
                'kelembapan' => $faker->numberBetween(55, 98),
                'update_terakhir' => $faker->dateTimeBetween('-7 days', 'now'),
            ]);
        }

    }
}
