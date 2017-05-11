<?php

use Illuminate\Database\Seeder;
use App\Food;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $foods = ['food1','food2','food3','food4','food5','food6'];
          foreach($foods as $foodName) {
          $food = new Food();
          $food->food =$foodName;
          $food->calories=111;
          $food->save();
        }

    }
}
