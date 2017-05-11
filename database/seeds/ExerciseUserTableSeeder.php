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
      'abcabc' => ['ex1','ex2','ex3'],
      '123123' => ['ex1','ex2','ex3']


  ];

  # Now loop through the above array, creating a new pivot for each book to tag
  foreach($users as $name => $exercises) {

      # First get the book
      $user = User::where('name','like',$name)->first();

      # Now loop through each tag for this book, adding the pivot
      foreach($exercises as $exerciseName) {
          $exercise = Exercise::where('exercise','=',$exerciseName)->first();

          # Connect this tag to this book
          $user->exercises()->save($exercise);
      }

  }


    }
}
