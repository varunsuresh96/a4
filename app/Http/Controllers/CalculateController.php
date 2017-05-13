<?php

namespace App\Http\Controllers;

require('BmiController.php');

use Illuminate\Http\Request;
use App\Food;
use App\Exercise;
use App\User;

class CalculateController extends Controller
{

    //This function displays the form required to calculate the BMI.
    public function bmiForm(Request $request)
    {
        $weight=null;
        $height=null;
        $age=null;
        $calories=null;
        $gender='male';
        $activity='sedentary';
        $goal='lose';
        $submitted=0;
        $bmi=0;
        $calChecked=0;
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

    //This function calculates the users BMI
    public function bmi(Request $request)
    {
      // Validate the user inputs and if validation fails, return the custom error messages

        $bmiObject= new BmiController();

        // Assign the user's inputs to the appropriate variables

        $submitted=$request->all();

        if ($submitted)
        {
            $this->validate($request,
            [
                'weight' => 'required|numeric|min:1',
                'height' => 'required|numeric|min:1',
                'age' => 'required|numeric|min:1',
            ],

            [
                'weight.required' => 'Please enter your weight',
                'weight.numeric' => 'Please enter a numerical value height',
                'weight.min:1' => 'Please enter a positive number for weight',

                'height.required' => 'Please enter your height',
                'height.numeric' => 'Please enter a numerical value for height',
                'height.min' => 'Please enter a positive number for height',

                'age.required' => 'Please enter your age',
                'age.numeric' => 'Please enter a numerical value for age',
                'age.min' => 'Please enter a positive integer for age',
            ]);

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

            $bmi=$bmiObject->bmiCal($weight,$height);
            $calories=$bmiObject->caloriesCal($weight, $height,$gender,$age,$activity,$goal);

            //Update calories required, activity level and goal each time the person checks their BMI.
            $user = $request->user()->name;
            $userCal=User::where('name','=',$user)->first();
            $userCal->caloriesRequired=$calories;
            $userCal->goal=$goal;
            $userCal->save();

            $submitted=true;
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

    /* This function renders two pie charts describing the percentage of calories left to be consumed and
       exercise left to be performed.
    */

    public function home(Request $request)
    {
        $user = $request->user()->name;
        /*
            IMPORTANT:Checks if user has calculated his/her required calories. If not, they are redirected
            to the bmi calculation page. This check is necessary for most functions because the required
            calculations cannot be performed unless the calories required has been calculated first.
        */
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $calArray=$this->calculateCalories($user);

        return view('bmi.home')->with([
            'caloriesConsumed' => round(($calArray[2]/$calArray[1])*100,2),
            'caloriesLeft1' => round(($calArray[3]/$calArray[1])*100,2),
            'caloriesBurned' => round(($calArray[5]/$calArray[4])*100,2),
            'caloriesLeft2' => round(($calArray[6]/$calArray[4])*100,2)
        ]);
    }

    //This function can be used to add a food item to the list of food consumed by the user
    public function food(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $food= new Food();
        //Get the name of all the food items in the database.
        $foodList= $food->pluck('food');

        $selectedFood=$request->input('food');
        $foodId=Food::where('food','=',$selectedFood)->pluck('id');

        //Attach the selected food to the respective user and enter this record into the pivot table.
        $users = User::where('name','=',$user)->first();
        $users->save();
        $users->foods()->attach($foodId);

        return view('bmi.food')->with([
            'foodList'=>$foodList,
            'users'=>$users
        ]);
    }

    // This function is used to add a new food item to the database.
    public function newFood(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }
        return view('bmi.newFood');
    }
    // This page validates and connects the food item to the user.
    public function newFoodAdded(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $this->validate($request, [
            'newFood' => 'required',
            'newCalories' => 'required|numeric|min:1',
        ],

        [
            'newFood.required' => 'Please enter a food item',

            'newCalories.required' => 'Please enter a calorific value',
            'newCalories.numeric' => 'Please enter a numerical value for calories',
            'newCalories.min' => 'Please enter a positive value for calories',
        ]);

        $food= new Food();
        $food->food=$request->newFood;
        $food->calories=$request->newCalories;
        $food->save();

        return view('bmi.newFoodAdded')->with([
            'food' =>$food
        ]);
    }

    //This function deletes a food item from the food table.
    public function deleteFood(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $foodList= new Food();
        $foodList= $foodList->pluck('food');

        return view('bmi.deleteFood')->with([
            'foodList'=>$foodList
        ]);
    }

    //This function validates and detaches the food item from the user.
    public function foodDeleted(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $this->validate($request, [
            'food' => 'required'
        ],
        [
            'food.required' => 'Please select a food item',
        ]);

        $food=$request->input('food');
        $food = Food::where('food', '=', $food)->first();
        $foodId=$food->id;

        //Detach the food from the user and then delete it from the database.
        $users = User::where('name','=',$user)->first();
        $users->foods()->detach($foodId);
        $users->save();
        $food->delete();

        return view('bmi.foodDeleted')->with([
            'food' =>$food
        ]);
    }

    //This function adds the exercise to the list of exercises performed by the user.
    public function exercise(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $exercise= new Exercise();
        $exerciseList= $exercise->pluck('exercise');

        $selectedExercise=$request->input('exercise');
        $exerciseId=Exercise::where('exercise','=',$selectedExercise)->pluck('id');

        //Attach exercise to user and store the record in the pivot table
        $users = User::where('name','=',$user)->first();
        $users->save();
        $users->exercises()->attach($exerciseId);

        return view('bmi.exercise')->with([
            'exerciseList'=>$exerciseList,
            'users'=>$users
        ]);
    }
    // This function adds a new exercise to the exercise table.
    public function newExercise(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }
        return view('bmi.newExercise');
    }

    // This function validates and stores the exercise in the exercise table.
    public function newExerciseAdded(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $this->validate($request,
        [
            'newExercise' => 'required',
            'newCalories' => 'required|numeric|min:1',
        ],
        [
            'newExercise.required' => 'Please enter the name of the exercise',

            'newCalories.required' => 'Please enter the calories burned',
            'newCalories.numeric' => 'Please enter a numerical value for calories',
            'newCalories.min' => 'Please enter a positive value for calories',
        ]);

        $exercise= new Exercise();

        //Store the new exercise and calories to the exercise table.
        $exercise->exercise=$request->newExercise;
        $exercise->calories=$request->newCalories;
        $exercise->save();

        return view('bmi.newExerciseAdded')->with([
            'exercise' =>$exercise
        ]);
    }

    // This function is used to delete an exercise from the exercise table.
    public function deleteExercise(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        $exerciseList= new Exercise();
        $exerciseList= $exerciseList->pluck('exercise');

        return view('bmi.deleteExercise')->with([
            'exerciseList'=>$exerciseList
        ]);
    }

    // This function validates and detaches the exercise from the user and then deletes it from the table.
    public function exerciseDeleted(Request $request)
    {
        $user = $request->user()->name;
        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
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

        $exerciseId=$exercise->id;

        $users = User::where('name','=',$user)->first();

        //Detach exercise from user and then delete the exercise.
        $users->exercises()->detach();
        $users->save();
        $exercise->delete($exerciseId);

        return view('bmi.exerciseDeleted')->with([
            'exercise' => $exercise
        ]);
    }

    //This function redirects user if he tries to access /login while he is already logged in.
    public function login(Request $request)
    {
        $user = $request->user();
        if($user!=null)
        {
            return redirect('/home');
        }
        return view('auth.login');
    }

    /* This function calls upon a virtual coach page. This page has text that changes based on how you are doing
       based on your calories consumed and calories burned.
    */
    public function virtualCoach(Request $request)
    {
        $user = $request->user()->name;

        $calArray=$this->calculateCalories($user);
        //$caloriesRequired is located in index1 of this array.
        if($calArray==null)
        {
            return redirect('/bmi');
        }

        return view('bmi.virtualCoach')->with([
            'user' => $calArray[0],
            'caloriesRequired' => $calArray[1],
            'caloriesConsumed' => $calArray[2],
            'caloriesLeft1' => $calArray[3],
            'caloriesToBurn' => $calArray[4],
            'caloriesBurned' => $calArray[5],
            'caloriesLeft2' => $calArray[6],
        ]);
    }

    //This function is used to return relevant calorific values such as calories consumed,calories left, calories burned etc.
    public function calculateCalories($user)
    {
        $userRow=User::where('name','=',$user)->first();
        $caloriesRequired=$userRow->caloriesRequired;
        $caloriesToBurn=0;
        $goal=$userRow->goal;
        $userId=$userRow->id;
        $caloriesConsumed=0;
        $caloriesBurned=0;

        //$date can be used to make sure that only the food and exercises of the current day are taken into account.
        //http://stackoverflow.com/questions/33247908/get-only-records-created-today-in-laravel
        $date=new \DateTime('today');

        foreach($userRow->foods as $food)
        {
            //https://laracasts.com/discuss/channels/eloquent/how-to-access-data-of-a-pivot-table
            if($food->pivot->created_at>=$date)
            {
                $caloriesConsumed+=$food->calories;
            }
        }

        foreach($userRow->exercises as $exercise)
        {
            //https://laracasts.com/discuss/channels/eloquent/how-to-access-data-of-a-pivot-table
            if($exercise->pivot->created_at>=$date)
            {
                $caloriesBurned+=$exercise->calories;
            }
        }

        if($goal=='gain')
        {
            $caloriesToBurn=$caloriesRequired-500;
        }

        if($goal=='lose')
        {
            $caloriesToBurn=$caloriesRequired+500;
        }

        else
        {
            $caloriesToBurn=$caloriesRequired;
        }

        $caloriesLeft1=$caloriesRequired-$caloriesConsumed;
        $caloriesLeft2=$caloriesToBurn-$caloriesBurned;

        $calArray=[$user,$caloriesRequired,$caloriesConsumed,$caloriesLeft1,
                  $caloriesToBurn,$caloriesBurned,$caloriesLeft2];

        return $calArray;
    }
}
