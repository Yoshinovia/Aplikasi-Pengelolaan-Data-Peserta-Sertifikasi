<?php

namespace Database\Factories;

use App\Models\CertificationScheme;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        $certificationScheme = CertificationScheme::factory()->create();
        
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'certification_scheme_code' => $certificationScheme->code,
        ];
    }
}