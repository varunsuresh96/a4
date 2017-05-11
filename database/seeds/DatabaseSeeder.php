<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(ExercisesTableSeeder::class);
        $this->call(FoodUserTableSeeder::class);
        $this->call(ExerciseUserTableSeeder::class);
        $path = 'app/Developer_docs/food table.sql';
        $path = 'app/Developer_docs/exercise table.sql';
        DB::unprepared(file_get_contents($path));
    }
}
