<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //: \App\Models\User:factory(10)->create();
        \App\Models\User::create([
            'name' => 'Vasco',
            'email' => 'vascomartins37@gmail.com',
            'password' => Hash::make('itmvasco')
        ]);

        \App\Models\User::create([
            'name' => 'Rui',
            'email' => 'rui.baptista@colgaia.pt',
            'password' => Hash::make('itmrui')
        ]);

        \App\Models\User::create([
            'name' => 'Miguel',
            'email' => 'miguel.personal@protonmail.com',
            'password' => Hash::make('itmmiguel')
        ]);


    }
}
