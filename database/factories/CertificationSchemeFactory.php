<?php

namespace Database\Factories;

use App\Models\CertificationScheme;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationSchemeFactory extends Factory
{
    protected $model = CertificationScheme::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('[A-Z]{2}-[0-9]{3}'),
            'name' => $this->faker->words(2, true) . ' Sertifikasi',
            'description' => $this->faker->sentence(),
        ];
    }
}