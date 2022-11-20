<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class JadwalPertandinganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tanggal' => fake()->date($format = 'Y-m-d', $min = 'now'),
            'waktu' => fake()->time($format = 'H:i:s', $max = 'now'),
            'tim_home' => 1,
            'tim_away' => 2,
            'total_skor_home' => 0,     
            'total_skor_away' => 0,       
        ];
    }

}
