<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
* Main page which calculates the BMI and required calories.
*/

if(config('app.env') == 'local') {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

}

Route::group(['middleware' => 'auth'], function () {


Route::get('/virtualcoach', 'CalculateController@virtualCoach');

Route::get('/bmi', 'CalculateController@bmi');
Route::get('/deletefood', 'CalculateController@deleteFood');
Route::post('/deletefood', 'CalculateController@foodDeleted');

Route::get('/deleteexercise', 'CalculateController@deleteExercise');
Route::post('/deleteexercise', 'CalculateController@exerciseDeleted');

Route::get('/home', 'CalculateController@home');
Route::get('/food', 'CalculateController@food');
Route::get('/exercise','CalculateController@exercise');
Route::get('/newfood','CalculateController@newFood');
Route::post('/newfood','CalculateController@newFoodAdded');
Route::get('/newexercise','CalculateController@newExercise');
Route::post('/newexercise','CalculateController@newExerciseAdded');
});
Route::get('/','CalculateController@login');

Auth::routes();
