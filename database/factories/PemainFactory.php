<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PemainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'tinggi_badan' => fake()->numberBetween($min = 140, $max = 250),
            'berat_badan' => fake()->numberBetween($min = 40, $max = 200),
            'posisi' => fake()->randomElement($array = array ('penyerang','gelandang','bertahan','penjaga gawang')),
            'nomor_punggung' => rand(1,50),       
        ];
    }
}
