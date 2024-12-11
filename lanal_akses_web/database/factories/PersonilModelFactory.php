<?php

namespace Database\Factories;

use App\Models\PersonilModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonilModelFactory extends Factory
{
    protected $model = PersonilModel::class;

    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name,
            'nrp' => $this->faker->regexify('[A-Z0-9]{7}/P'),
            'jabatan' => $this->faker->jobTitle,
        ];
    }
}
