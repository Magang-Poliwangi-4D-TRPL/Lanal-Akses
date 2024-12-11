<?php

namespace Database\Factories;

use App\Models\KehadiranModel;
use App\Models\PersonilModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class KehadiranModelFactory extends Factory
{
    protected $model = KehadiranModel::class;

    public function definition()
    {
        return [
            'personil_id' => PersonilModel::factory(),
            'tanggal_kehadiran' => now(),
            'status_kehadiran' => 'Hadir',
            'jam_masuk' => now()->subHours(1), // contoh jam masuk sebelum waktu sekarang
            'jam_pulang' => now(),
            'lokasi' => $this->faker->latitude . ',' . $this->faker->longitude,
        ];
    }
}
