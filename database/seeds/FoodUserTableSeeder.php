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
      'John' => array(array('Egg boiled',80),array('Curd',100),array('Chapati',60)),
      'Linda' => array(array('Salad',100),array('Chinese noodles',450),array('Pizza',400))


  ];

  foreach($users as $name => $foods) {


      $user = User::where('name','like',$name)->first();

      foreach($foods as $foodName) {
          $food = Food::where('food','LIKE',$foodName)->first();

          $user->foods()->save($food);
      }

  }

    }
}
