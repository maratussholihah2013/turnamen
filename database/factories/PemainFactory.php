<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tim;

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
            'nomor_punggung' => fake()->unique()->numberBetween($min = 1, $max = 100),
            'tim_id' => Tim::all()->random()->id,       
        ];
    }
}
