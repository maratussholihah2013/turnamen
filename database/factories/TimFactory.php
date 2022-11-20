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
            'nama' => fake()->name(),
            'logo' => fake()->image('public/storage/',400,400, null, false),
            'tahun_berdiri' => fake()->year($max = 'now')  ,
            'alamat' => fake() ->address(),
            'kota' => fake()->city(),
        ];
    }

}
