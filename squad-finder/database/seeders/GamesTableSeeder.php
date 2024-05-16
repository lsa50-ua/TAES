<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();
        $datos = [
            [
                'name' => 'Valorant',
                'description' => 'Tactical shooter in which players assume the control of agents from the Valorant protocol, each with a unique set of abilities.',
                'creationDate' => NOW(),
                'img' => '/images/valorant.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'League Of Legends',
                'description' => 'Online game in which two teams of five players compete to destroy the enemy base while defending their own.',
                'creationDate' => NOW(),
                'img' => '/images/lol.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Call of Duty: Warzone',
                'description' => 'Battle royale game in which up to 150 players compete in teams of three to be the last team standing.',
                'creationDate' => NOW(),
                'img' => 'images/warzone.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Fortnite',
                'description' => 'Battle royale game in which up to 100 players compete to be the last person standing.',
                'creationDate' => NOW(),
                'img' => 'images/fortnite.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Counter Strike: Global Offensive',
                'description' => 'Online tactical shooter in which two teams of five players compete to eliminate the other.',
                'creationDate' => NOW(),
                'img' => 'images/csgo.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Overwatch',
                'description' => 'Online team-based first-person shooter in which two teams of six players compete to secure and defend control points.',
                'creationDate' => NOW(),
                'img' => 'images/overwatch.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Rainbow Six Siege',
                'description' => 'Online tactical shooter in which two teams of five players compete to eliminate the other.',
                'creationDate' => NOW(),
                'img' => 'images/r6.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Rocket League',
                'description' => 'Online game in which two teams of three players compete to score goals with a car.',
                'creationDate' => NOW(),
                'img' => 'images/rocket.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'FIFA 21',
                'description' => 'Online game in which two teams of eleven players compete to score goals with a ball.',
                'creationDate' => NOW(),
                'img' => 'images/fifa.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'NBA 2K21',
                'description' => 'Online game in which two teams of five players compete to score points with a ball.',
                'creationDate' => NOW(),
                'img' => 'images/nba.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Minecraft',
                'description' => 'Online game in which players can build constructions out of textured cubes in a 3D procedurally generated world.',
                'creationDate' => NOW(),
                'img' => 'images/minecraft.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Among Us',
                'description' => 'Online game in which players must work together to complete tasks while trying to figure out who the impostor is.',
                'creationDate' => NOW(),
                'img' => 'images/among.png',
                // 'platform_id' => 1    
            ],
            [
                'name' => 'Halo',
                'description' => 'Online shooter game in which two teams of five players compete to eliminate the other.',
                'creationDate' => NOW(),
                'img' => 'images/halo.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Forza Horizon 4',
                'description' => 'Online racing game in which players compete to be the first to cross the finish line.',
                'creationDate' => NOW(),
                'img' => 'images/forza.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Clash of Clans',
                'description' => 'Online game in which players must build their own village and attack other players to earn gold and elixir.',
                'creationDate' => NOW(),
                'img' => 'images/clash.png',
                // 'platform_id' => 1    
            ],
            [
                'name' => 'Clash Royale',
                'description' => 'Online game in which players must destroy the enemy towers while defending their own.',
                'creationDate' => NOW(),
                'img' => 'images/royale.png',
                // 'platform_id' => 1
            ],
            [
                'name' => 'Mario Kart',
                'description' => 'Online racing game in which players compete to be the first to cross the finish line.',
                'creationDate' => NOW(),
                'img' => 'images/mario.png',
                // 'platform_id' => 1    
            ],
            [
                'name' => 'Super Smash Bros',
                'description' => 'Online fighting game in which players must defeat their opponents to win.',
                'creationDate' => NOW(),
                'img' => 'images/smash.png',
                // 'platform_id' => 1
            ]
        ];

        // Iteramos sobre los datos y los insertamos en la tabla
        foreach ($datos as $dato) {

            DB::table('games')->insert([
                'name' => $dato['name'],
                'description' => $dato['description'],
                'creationDate' => $dato['creationDate'],
                'img' => $dato['img'],
                // 'platform_id' => $dato['platform_id']

            ]);
        }
    }
}
