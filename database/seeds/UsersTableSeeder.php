<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
            'name' => 'Alexandre Rodrigues',
            'username' => '2190273',
            'email' => '2190273@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Filipa Fonte',
            'username' => '2190278',
            'email' => '2190278@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'João Santos',
            'username' => '2190274',
            'email' => '2190274@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Ricardo Rodrigues',
            'username' => '2190275',
            'email' => '2190275@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Developer',
            'username' => 'dev',
            'email' => 'dev@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Vendedor',
            'username' => 'salesman',
            'email' => 'sales@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Cliente',
            'username' => 'client',
            'email' => 'client@my.ipleiria.pt',
            'password' => bcrypt('secret'),
        ]);
    }
}
