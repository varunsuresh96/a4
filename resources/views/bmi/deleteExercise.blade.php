{{-- /resources/views/bmi/deleteExercise.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Delete Exercise</h1>

    <form method="POST" id='ex ' action="/deleteexercise">
    {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <input list="exercise" autocomplete="off" autofocus class="form-control" name="exercise" placeholder="Exercise" type="text"/>
                <datalist id="exercise">
                    @foreach($exerciseList as $exercise)
                        <option value="{{$exercise}}">
                    @endforeach
                </datalist>
            </div>

            @if($errors->get('exercise'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('exercise') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <button class="btn btn-default" type="submit">Delete</button>
            </div>
        </fieldset>
    </form>
@endsection
