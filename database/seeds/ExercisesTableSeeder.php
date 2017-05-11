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
      $exercises = ['ex1','ex2','ex3'];
          foreach($exercises as $exerciseName) {
          $exercise = new Exercise();
          $exercise->exercise =$exerciseName;
          $exercise->calories=111;
          $exercise->save();
        }

    }
}
