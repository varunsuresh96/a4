{{-- /resources/views/bmi/newFood.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Nutrition</h1>


    <form method="POST" id='nutrition' action="/newfood">
      {{ csrf_field() }}

        <fieldset>

            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="newFood" placeholder="Food Item" type="text" value='{{ $newFood or old('newFood')}}'/>
            </div>
            @if($errors->get('newFood'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('newFood') as $error)
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
