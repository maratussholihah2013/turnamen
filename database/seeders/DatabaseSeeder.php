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
        \App\Models\User::factory(1)->create();
        \App\Models\Tim::factory(3)->create();
        \App\Models\Pemain::factory(40)->create();
        \App\Models\JadwalPertandingan::factory(6)->create();
        
        $jadwals = \App\Models\JadwalPertandingan::all();
        foreach ($jadwals as $jadwal) {
            $pemains = \App\Models\Pemain::whereIn('tim_id',[$jadwal->tim_home,$jadwal->tim_away])->get();
            $pemainsGol = $pemains->random(5);
            foreach ($pemainsGol as $pemain) {                
                \App\Models\HasilPertandingan::factory(rand(1,4))
                                                ->create([
                                                    'pemain_id' => $pemain->id,
                                                    'jadwal_id' => $jadwal->id
                                                ]);
                if($pemain->tim_id == $jadwal->tim_home)
                    $jadwal->update(['total_skor_home' => $jadwal->total_skor_home+1]);
                else if($pemain->tim_id == $jadwal->tim_away)
                    $jadwal->update(['total_skor_away' => $jadwal->total_skor_away+1]);
                $jadwal->save();
            }           
        }
    }
}
