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
Route::get('/virtualcoach', 'CalculateController@virtualCoach');
Route::get('/','CalculateController@logout');

Route::get('/bmi', 'CalculateController@bmi');
Route::get('/deletefood', 'CalculateController@deleteFood');
Route::post('/deletefood', 'CalculateController@foodDeleted');

Route::get('/deleteexercise', 'CalculateController@deleteExercise');
Route::post('/deleteexercise', 'CalculateController@exerciseDeleted');

Route::get('/home', 'CalculateController@index');
Route::get('/food', [
    'middleware'=>'auth',
    'uses' => 'CalculateController@food'
    ]);
Route::get('/exercise', [
    'middleware'=>'auth',
    'uses' => 'CalculateController@exercise'
    ]);
Route::get('/newfood', [
    'middleware'=>'auth',
    'uses' => 'CalculateController@newFood'
    ]);
Route::post('/newfood',[
    'middleware'=>'auth',
    'uses' => 'CalculateController@newFoodAdded'
    ]);
Route::get('/newexercise',[
    'middleware'=>'auth',
    'uses' => 'CalculateController@newExercise'
    ]);
Route::post('/newexercise',[
    'middleware'=>'auth',
    'uses' => 'CalculateController@newExerciseAdded'
    ]);

Route::get('/practice','CalculateController@practice');
/**
* Log viewer
* (only accessible locally)
*/

if(config('app.env') == 'local') {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

}

Auth::routes();
