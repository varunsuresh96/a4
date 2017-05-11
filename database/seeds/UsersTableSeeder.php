<?php

use Illuminate\Database\Seeder;
use App\BMI;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $user = \App\User::firstOrCreate([

               'name' => '123123',

               'password' => \Hash::make('123123'),

               'caloriesRequired' => '1500',

               'goal' => 'lose'
             ]);

             $user = \App\User::firstOrCreate([

                     'name' => 'abcabc',

                     'password' => \Hash::make('abcabc'),

                     'caloriesRequired' => '1360',

                     'goal' => 'lose'
                   ]);
     }
}
