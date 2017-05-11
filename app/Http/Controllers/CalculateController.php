<?php

namespace App\Http\Controllers;

require('BmiController.php');

use Illuminate\Http\Request;
use App\Food;
use App\Exercise;
use App\User;

class CalculateController extends Controller
{
    public function bmi(Request $request)
    {
        $bmiObject= new BmiController();

        // Assign the user's inputs to the appropriate variables
        $weight = $request->input('weight',null);
        $height = $request->input('height',null);
        $age = $request->input('age',null);
        $gender = $request->input('gender','male');
        $activity = $request->input('activity','sedentary');
        $gender = $request->input('gender','male');
        $goal = $request->input('goal','lose');
        $calChecked= $request->has('calories');
        $bmi=0;
        $calories=0;
        $submitted=$request->all();

        if ($submitted)
        {
            // Validate the user inputs and if validation fails, return the custom error messages.
            $this->validate($request, [
                'weight' => 'required|numeric|min:1',
                'height' => 'required|numeric|min:1',
                'age' => 'required|numeric|min:1',
                ],

                [
                'weight.required' => 'Please enter your weight',
                'weight.numeric' => 'Please enter a numerical value',
                'weight.min:1' => 'Please enter a positive number',

                'height.required' => 'Please enter your height',
                'height.numeric' => 'Please enter a numerical value',
                'height.min' => 'Please enter a positive number',

                'age.required' => 'Please enter your age',
                'age.numeric' => 'Please enter a numerical value',
                'age.min' => 'Please enter a positive integer',
            ]);

            $submitted=true;
            $bmi=$bmiObject->bmiCal($weight,$height);



            $calories=$bmiObject->caloriesCal($weight, $height,$gender,$age,$activity,$goal);


            $user = $request->user()->name;
            $userCal=User::where('name','=',$user)->first();
            $userCal->caloriesRequired=$calories;
            $userCal->goal=$goal;
            $userCal->save();

        }
        return view('bmi.bmi')->with([
            'weight' => $weight,
            'height' => $height,
            'age' => $age,
            'calories' => $calories,
            'gender' => $gender,
            'activity' => $activity,
            'goal' => $goal,
            'submitted'=>$submitted,
            'bmi' =>$bmi,
            'calChecked'=>$calChecked
        ]);
    }

    public function index(Request $request)
    {
      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }

      $calArray=$this->calculateCalories($user);

        return view('bmi.home')->with([
            'caloriesConsumed' => round(($calArray[2]/$calArray[1])*100,2),
            'caloriesLeft1' => round(($calArray[3]/$calArray[1])*100,2),
            'caloriesBurned' => round(($calArray[4]/$calArray[1])*100,2),
            'caloriesLeft2' => round(($calArray[5]/$calArray[1])*100,2)
        ]);

    }

    public function food(Request $request)
    {
      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }

      $food= new Food();
      $foodList= $food->pluck('food');

      $selectedFood=$request->input('food');
      $foodId=Food::where('food','=',$selectedFood)->pluck('id');

      $users = User::where('name','=',$user)->first();
      $users->save();
      $users->foods()->attach($foodId);

      return view('bmi.nutrition')->with([
        'foodList'=>$foodList,
        'users'=>$users
        ]);
    }
      public function newFood(Request $request){

        $user = $request->user()->name;
        if($this->getCaloriesRequired($user)==null){
          return redirect('/bmi');
        }
        return view('bmi.newFood');

      }

    public function newFoodAdded(Request $request){

      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }

    $this->validate($request, [

    'newFood' => 'required',
    'newCalories' => 'required|numeric|min:1',
    ],

  [
  'newFood.required' => 'Please enter a food item',

  'newCalories.required' => 'Please enter a calorific value',
  'newCalories.numeric' => 'Please enter a numerical value',
  'newCalories.min' => 'Please enter a positive value',


]);

    $food= new Food();

    $food->food=$request->newFood;
    $food->calories=$request->newCalories;
    $food->save();

    return view('bmi.newFoodAdded');
      }

      public function deleteFood(Request $request){

        $user = $request->user()->name;
        if($this->getCaloriesRequired($user)==null){
          return redirect('/bmi');
        }

        $foodList= new Food();
        $foodList= $foodList->pluck('food');

        return view('bmi.deleteFood')->with([
          'foodList'=>$foodList
          ]);

      }

      public function foodDeleted(Request $request){

        $user = $request->user()->name;
        if($this->getCaloriesRequired($user)==null){
          return redirect('/bmi');
        }

        $this->validate($request, [

        'food' => 'required'
        ],

      [
      'food.required' => 'Please select a food item',
    ]);
      $user = $request->user()->name;
      $food=$request->input('food');
      $food = Food::where('food', '=', $food)->first();


      $foodId=Food::where('food','=',$food)->pluck('id');

      $users = User::where('name','=',$user)->first();

      $users->foods()->detach();
      $users->save();
      $food->delete();

      return view('bmi.foodDeleted');
        }



    public function exercise(Request $request)
    {
      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }

      $user = $request->user()->name;
      $caloriesRequired=User::where('name','=',$user)->pluck('caloriesRequired');
      if($caloriesRequired==null){
        redirectTo(bmi.index);
      }
      $exercise= new Exercise();
      $exerciseList= $exercise->pluck('exercise');

      $selectedExercise=$request->input('exercise');
      $exerciseId=Exercise::where('exercise','=',$selectedExercise)->pluck('id');

      $users = User::where('name','=',$user)->first();
      $users->save();
      $users->exercises()->attach($exerciseId);
      //dump($users->exercises);
      foreach($users->exercises as $exercise) {
      }

      return view('bmi.exercise')->with([
        'exerciseList'=>$exerciseList,
        'users'=>$users
        ]);
    }

    public function newExercise(Request $request){

      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }
      return view('bmi.newExercise');

    }

    public function newExerciseAdded(Request $request){

      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }
      $this->validate($request, [

      'newExercise' => 'required',
      'newCalories' => 'required|numeric|min:1',
      ],

    [
    'newExercise.required' => 'Please enter the name of the exercise',

    'newCalories.required' => 'Please enter the calories burned',
    'newCalories.numeric' => 'Please enter a numerical value',
    'newCalories.min' => 'Please enter a positive value',


  ]);

  $exercise= new Exercise();
  //$food->food=$newFood;
  //$food->calories=$newFoodCal;
  $exercise->exercise=$request->newExercise;
  $exercise->calories=$request->newCalories;
  $exercise->save();

  return view('bmi.newExerciseAdded');
    }

    public function deleteExercise(Request $request){

      $user = $request->user()->name;
      if($this->getCaloriesRequired($user)==null){
        return redirect('/bmi');
      }
      $exerciseList= new Exercise();
      $exerciseList= $exerciseList->pluck('exercise');

      return view('bmi.deleteExercise')->with([
        'exerciseList'=>$exerciseList
        ]);
}

public function exerciseDeleted(Request $request){

  $user = $request->user()->name;
  if($this->getCaloriesRequired($user)==null){
    return redirect('/bmi');
  }
  $this->validate($request, [

  'exercise' => 'required'
  ],

[
'exercise.required' => 'Please select an exercise',
]);
$user = $request->user()->name;
$exercise=$request->input('exercise');
$exercise = Exercise::where('exercise', '=', $exercise)->first();


$exerciseId=Exercise::where('exercise','=',$exercise)->pluck('id');

$users = User::where('name','=',$user)->first();

$users->exercises()->detach();
$users->save();
$exercise->delete();

return view('bmi.exerciseDeleted');

}

public function getCaloriesRequired($user)
{
  $caloriesRequired=User::where('name','=',$user)->pluck('caloriesRequired');
  return $caloriesRequired[0];
}

public function logout(Request $request)
{
  $user = $request->user();
  if($user==null)
  return view('bmi.logout');
  else {
    return redirect()->back();
  }
}

public function virtualCoach(Request $request)
{
  $user = $request->user()->name;
  if($this->getCaloriesRequired($user)==null){
    return redirect('/bmi');

    $calArray=$this->calculateCalories($user);
    $consumed=false;

    if($calArray[1]>$calArray[2]){
        $consumed=true;
    }
    return view('bmi.virtualCoach')->with([
        'user' => $calArray[0],
        'caloriesRequired' => $calArray[1],
        'caloriesConsumed' => $calArray[2],
        'caloriesLeft1' => $calArray[3],
        'caloriesBurned' => $calArray[4],
        'caloriesLeft2' => $calArray[5],
        'consumed' => $consumed
    ]);
}
}

public function calculateCalories($user){
  $userRow=User::where('name','=',$user)->first();
  $caloriesRequired=$userRow->caloriesRequired;

  $userId=$userRow->id;
  $caloriesConsumed=0;
  $caloriesBurned=0;

  foreach($userRow->foods as $food) {
      $caloriesConsumed+=$food->calories;
  }

  foreach($userRow->exercises as $exercise) {
      $caloriesBurned+=$exercise->calories;
  }

  $caloriesLeft1=$caloriesRequired-$caloriesConsumed;
  $caloriesLeft2=$caloriesRequired-$caloriesBurned;


  $calArray=[$user,$caloriesRequired,$caloriesConsumed,$caloriesLeft1,$caloriesBurned,$caloriesLeft2];
  return $calArray;
}

}
