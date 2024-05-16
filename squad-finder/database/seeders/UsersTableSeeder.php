<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@secretmail.com',
                'password' => Hash::make('admin'),
                'registerDate' => '2021-01-01',
                'isAdmin' => true,
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Borja Iglesias',
                'email' => 'biglesias@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Nabil Fekir',
                'email' => 'nfekir@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Sergio Canales',
                'email' => 'scanales@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Andres Guardado',
                'email' => 'aguardado@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ],
            [
                'name' => 'Ayoze Perez',
                'email' => 'aperez@gmail.com',
                'password' => Hash::make('password'),
                'registerDate' => '2021-01-01',
                'isAdmin' => false,
            ]
        ]);

        $users = User::All();

        foreach($users as $user){
            switch($user->id){
                case 4: $user->myfriends()->attach([5, 6, 7, 8]); break;
                case 5: $user->myfriends()->attach([4, 6, 7, 8]); break;
                case 6: $user->myfriends()->attach([4, 5, 7, 8]); break;
                case 7: $user->myfriends()->attach([4, 5, 6, 8]); break;
                case 8: $user->myfriends()->attach([4, 5, 6, 7]); break;
            }
        }



        

        
    }
}
