<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $exercises = array(array('Cycling, <10 mph, leisure bicycling',236),array('Cycling, 16-19 mph, very fast, racing',670),array('Unicycling',295),array('Stationary cycling, moderate',415),array('Calisthenics',310),array('Circuit training, minimal rest',480),
                     array('Weight lifting',250),array('Stair machine',495),array('Rowing machine',320),array('Aerobics',365),array('Stretching',220),array('Running(5 miles)',470),
                     array('Jogging',200),array('Dancing,competitive',450),array('Pool table',100),array('Swimming',600),array('Trekking',550),
                     array('Running, cross country',540),array('Badminton',670),array('Basketball, competitive',480),array('Fencing',355),array('Football',520),array('Sailing',295),
                     array('Ski mobiling',415),array('Ice skating',435),array('Tennis',600));
          foreach($exercises as $exerciseName) {
          $exercise = new Exercise();
          $exercise->exercise =$exerciseName[0];
          $exercise->calories=$exerciseName[1];
          $exercise->save();
        }

    }
}
