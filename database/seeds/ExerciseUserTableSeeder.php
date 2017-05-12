<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Exercise;

class ExerciseUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
            'John' => array(array('Cycling, <10 mph, leisure bicycling',236),array('Cycling, 16-19 mph, very fast, racing',670),array('Unicycling',295)),
            'Linda' => array(array('Dancing,competitive',450),array('Pool table',100),array('Swimming',600))
        ];

        foreach($users as $name => $exercises)
        {
            $user = User::where('name','like',$name)->first();

            foreach($exercises as $exerciseName)
            {
                $exercise = Exercise::where('exercise','=',$exerciseName)->first();
                $user->exercises()->save($exercise);
            }
        }
    }
}
