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
        $foods = array(array('Egg boiled',80),array('Egg Fried',110),array('Bread slice',45),array('Chapati',60),array('Puri',75),array('Paratha',150),
            array('Subji',150),array('Idli',100),array('Dosa Plain',120),array('Masala Dosa',250),array('Sambhar',150),array('Dal',150),
            array('Curd',100),array('Vegetable curry',150),array('Meat curry',180),array('Salad',100),array('Fruit(1 average serving)',100),
            array('Tea',45),array('Coffee',45),array('Soft Drinks',150),array('Alcohol neat',75),array('Porridge',150),array('Biscuit',35),
            array('Ice cream(1 cup)',200),array('Breakfast cereal with milk',130),array('Potato mash',100),array('Potato fried',200),
            array('Hamburger',250),array('Steak and Salad',300),array('Spaghetti & meat/sauce',450),array('Fried chicken',200),array('Chinese noodles',450),
            array('Chinese fried rice',450),array('Pizza',400));

        foreach($foods as $foodName)
        {
            $food = new Food();
            $food->food =$foodName[0];
            $food->calories=$foodName[1];
            $food->save();
        }
    }
}
