<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platforms')->delete();
        // Añadimos una entrada a esta tabla
        Platform::create(
            [
                'name' => 'PlayStation',
                'image' => '/images/ps.png',
                'description' => 'PlayStation is a Japanese video game brand that consists of five home video game consoles, as well as a media center, an online service, a line of controllers, two handhelds and a phone, as well as multiple magazines.',
                'website' => 'https://www.playstation.com/es-es/'
            ]
        );
        Platform::create(
            [
                'name' => 'Xbox',
                'image' => '/images/xbox.png',
                'description' => 'Xbox is a video gaming brand created and owned by Microsoft. The brand consists of five video game consoles, as well as applications (games), streaming services, an online service by the name of Xbox Live, and the development arm by the name of Xbox Game Studios.',
                'website' => 'https://www.xbox.com/es-ES'
            ]
        );
        Platform::create(
            [
                'name' => 'Nintendo',
                'image' => '/images/nintendo.png',
                'description' => 'Nintendo Co., Ltd. is a Japanese multinational consumer electronics and video game company headquartered in Kyoto. The company was founded in 1889 as Nintendo Karuta by craftsman Fusajiro Yamauchi and originally produced handmade hanafuda playing cards.',
                'website' => 'https://www.nintendo.es/'
            ]
        );
        Platform::create(
            [
                'name' => 'PC',
                'image' => '/images/pc.png',
                'description' => 'A personal computer (PC) is a multi-purpose computer whose size, capabilities, and price make it feasible for individual use. Personal computers are intended to be operated directly by an end user, rather than by a computer expert or technician.',
                'website' => 'https://www.pccomponentes.com/'
            ]
        );
        Platform::create(
            [
                'name' => 'Mobile',
                'image' => '/images/mobile.png',
                'description' => 'A mobile game is a game played on a mobile phone (feature phone or smartphone), tablet, smartwatch, PDA, portable media player or graphing calculator. The earliest known game on a mobile phone was a Tetris variant on the Hagenuk MT-2000 device from 1994.',
                'website' => 'https://www.apple.com/es/ios/app-store/'
            ]
        );

        $games = \App\Models\Game::all();
        // Platform::all()->each(function ($platform) use ($games) {
        //     $platform->games()->attach(
        //         $games->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });
        $platforms = \App\Models\Platform::all();
        foreach ($platforms as $platform) {
            if ($platform->name == 'PlayStation') {
                $platform->games()->attach([3, 4, 6, 7, 8, 9, 10, 11, 13]);
            } elseif ($platform->name == 'Xbox') {
                $platform->games()->attach([3, 4, 9, 10, 11, 13, 14]);
            } elseif ($platform->name == 'Nintendo') {
                $platform->games()->attach([11, 17, 18]);
            } elseif ($platform->name == 'PC') {
                $platform->games()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]);
            } elseif ($platform->name == 'Mobile') {
                $platform->games()->attach([15, 16]);
            }
        };
    }
    

}
