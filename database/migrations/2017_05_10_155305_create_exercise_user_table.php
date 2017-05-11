<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('exercise_user', function (Blueprint $table) {

          $table->increments('id');
          $table->timestamps();

          # `book_id` and `tag_id` will be foreign keys, so they have to be unsigned
          #  Note how the field names here correspond to the tables they will connect...
          # `book_id` will reference the `books table` and `tag_id` will reference the `tags` table.
          $table->integer('exercise_id')->unsigned();
          $table->integer('user_id')->unsigned();

          # Make foreign keys
          #https://laravel.io/forum/06-10-2014-laravel-delete-query-exception-issue-please-help
          $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exercise_user');
    }
}
