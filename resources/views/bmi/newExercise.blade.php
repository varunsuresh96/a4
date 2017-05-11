{{-- /resources/views/bmi/newExercise.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Exercise</h1>


    <form method="POST" id='exercise' action="/newexercise">
      {{ csrf_field() }}

        <fieldset>

            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="newExercise" placeholder="Exercise Name" type="text" value='{{ $newExercise or old('newExercise')}}'/>
            </div>
            @if($errors->get('newExercise'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('newExercise') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="newCalories" placeholder="Calories" type="text"/>
            </div>
            @if($errors->get('newCalories'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('newCalories') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <button class="btn btn-default" type="submit">Add</button>
            </div>
        </fieldset>
    </form>

@endsection
