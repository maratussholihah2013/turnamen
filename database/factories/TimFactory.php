<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TimFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => fake()->company(),
            'logo' => 'dummy.jpg',
            'tahun_berdiri' => fake()->date($format = 'Y', $max = 'now'),
            'alamat' => fake() ->address(),
            'kota' => fake()->city(),
        ];
    }

}
