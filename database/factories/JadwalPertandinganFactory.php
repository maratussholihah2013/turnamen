<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tim;

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
        $timhome = Tim::all()->random()->id;
        
        $timaway = Tim::where('id','!=',$timhome)->get()->random()->id;
        return [
            'tanggal' => fake()->dateTimeBetween('+1 days', '+60 days')->format('Y-m-d'),
            'waktu' => fake()->time($format = 'H:i:s', $max = 'now'),
            'tim_home' => $timhome,
            'tim_away' => $timaway,
            'total_skor_home' => 0,     
            'total_skor_away' => 0,       
        ];
    }

}
