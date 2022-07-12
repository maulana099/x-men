<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperHero;

class SuperHeroSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $datas = [
            [
                'nama' => 'Proffesor X	',
                'jenis_kelamin' => 'Laki-Laki',
            ],
            [
                'nama' => 'Wolverine',
                'jenis_kelamin' => 'Laki-Laki',
            ],
            [
                'nama' => 'Raven',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'Beast',
                'jenis_kelamin' => 'Laki-Laki',
            ],
            [
                'nama' => 'Beast',
                'jenis_kelamin' => 'Perempuan',
                ]
            ];

            foreach ($datas as $data) {
                $superHero = SuperHero::firstOrNew(['nama' => $data['nama']]);
                $superHero->nama = $data['nama'];
                $superHero->jenis_kelamin = $data['jenis_kelamin'];
                $superHero->save();
            }
        }

    }
