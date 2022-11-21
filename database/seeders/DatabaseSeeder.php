<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::factory(2)->create();
        \App\Models\Tim::factory(5)->create()->each(function($t) {
            $t->pemains()
                ->saveMany(
                    \App\Models\Pemain::factory(12)->make()
                );
            $t->jadwals()
                ->saveMany(
                    \App\Models\JadwalPertandingan::factory(5)->make()
                )
                ->each(function ($j) {
                    $j->hasils()->saveMany(
                                \App\Models\HasilPertandingan::factory(5)->make([
                                    'pemain_id' =>\App\Models\Pemain::where('tim_id',$j->tim_home)->random()->id
                                ])
                            );
                    $j->hasils()->saveMany(
                                \App\Models\HasilPertandingan::factory(5)->make([
                                    'pemain_id' =>\App\Models\Pemain::where('tim_id',$j->tim_away)->random()->id
                                ])
                            );
                });
        });  
    }
}
