{{-- /resources/views/bmi/index.blade.php --}}
@extends('layouts.master')

@section('title')
    BMI Calculator
@endsection

@section('content')
    <h1>BMI Calculator</h1>
    <img src="images/bmi.jpg" alt="BMI Image"/>
    <form method='GET' action='/bmi'>
        <fieldset>
            <div class="form-group">
                <label for='weight'>* Weight(lbs)</label>
                <input type='text' id='weight' name='weight'  placeholder='Weight' autocomplete='off' class="form-control" value='{{ $weight or old('weight') }}'><br>
            </div>

            <!-- If there are any error messages, print them right after the input field. -->
            @if($errors->get('weight'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('weight') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for='height'>* Height(inches)</label>
                <input type='text' id='height' name='height' placeholder='Height' autocomplete='off' class="form-control" value='{{ $height or old('height') }}'><br>
            </div>

            <!-- If there are any error messages, print them right after the input field. -->
            @if($errors->get('height'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('height') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for='age'>* Age</label>
                <input type='text' id='age' name='age' placeholder='Age' autocomplete='off' class="form-control" value='{{ $age or old('age') }}'>
            </div>

            <!-- If there are any error messages, print them right after the input field. -->
            @if($errors->get('age'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('age') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Gender:</label>
                <label ><input type='radio' name='gender' value='male' {{ ($gender === 'male') ? 'CHECKED' : ''}} >Male</label>
                <label ><input type='radio' name='gender' value='female' {{ ($gender === 'female') ? 'CHECKED' : ''}} >Female</label>
            </div>

            <div class="form-group">
                <label>Activity level:</label>
                <label ><input type='radio' name='activity' value='sedentary' {{ ($activity === 'sedentary') ? 'CHECKED' : ''}} > Sedentary</label>
                <label ><input type='radio' name='activity' value='moderate' {{ ($activity === 'moderate') ? 'CHECKED' : ''}}> Moderate</label>
                <label><input type='radio' name='activity' value='active' {{ ($activity === 'active') ? 'CHECKED' : ''}} > Active</label>
            </div>

            <div class="form-group">
                <label>Activity level:</label>
                <label ><input type='radio' name='goal' value='lose' {{ ($goal === 'lose') ? 'CHECKED' : ''}} > Gain weight</label>
                <label ><input type='radio' name='goal' value='maintain' {{ ($goal === 'maintain') ? 'CHECKED' : ''}}> Maintain weight</label>
                <label><input type='radio' name='goal' value='gain' {{ ($goal === 'gain') ? 'CHECKED' : ''}} > Lose weight</label>
            </div>

            <div class="form-group">
                <label><input type='checkbox' name='calories' value='calories' {{ ($calories) ? 'CHECKED' : ''}} >Include calorie requirement</label>
            </div>

            <div class="form-group">
                <button type='submit' class='btn btn-primary btn-small'>Calculate</button>
            </div>
        </fieldset>
    </form>

    <!-- If the form has been submitted and there are no errors, then print the user's BMI -->
    @if($submitted and count($errors)==0)
        <div class='alert alert-success'>Your BMI is {{$bmi}}</div>

        <!-- Print the calories required if the checkbox has been checked by the user -->
        @if($calChecked)
            <div class='alert alert-success'>Your required calorie intake is {{$calories}}</div>
        @endif
    @endif

@endsection
