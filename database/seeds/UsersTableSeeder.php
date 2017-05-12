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
            'name' => 'John',
            'password' => \Hash::make('John'),
            'caloriesRequired' => '1500',
            'goal' => 'lose'
        ]);

        $user = \App\User::firstOrCreate([
            'name' => 'Linda',
            'password' => \Hash::make('Linda'),
            'caloriesRequired' => '1360',
            'goal' => 'gain'
        ]);
    }    
}
