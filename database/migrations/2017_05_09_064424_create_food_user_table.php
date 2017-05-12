<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('food_user', function (Blueprint $table) {
             $table->increments('id');
             $table->timestamps();
             $table->integer('food_id')->unsigned();
             $table->integer('user_id')->unsigned();
             # Make foreign keys
             #https://laravel.io/forum/06-10-2014-laravel-delete-query-exception-issue-please-help
             $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
             $table->foreign('user_id')->references('id')->on('users');
         });
     }

     public function down()
     {
         Schema::drop('food_user');
     }
}
