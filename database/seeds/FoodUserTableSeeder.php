<?php

use Illuminate\Database\Seeder;
use App\Food;
use App\User;
class FoodUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users =[
      'abcabc' => ['food1','food2','food3'],
      '123123' => ['food4','food5','food6']


  ];

  # Now loop through the above array, creating a new pivot for each book to tag
  foreach($users as $name => $foods) {

      # First get the book
      $user = User::where('name','like',$name)->first();

      # Now loop through each tag for this book, adding the pivot
      foreach($foods as $foodName) {
          $food = Food::where('food','LIKE',$foodName)->first();

          # Connect this tag to this book
          $user->foods()->save($food);
      }

  }

    }
}
