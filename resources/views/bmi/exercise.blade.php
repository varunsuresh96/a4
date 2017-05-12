{{-- /resources/views/bmi/exercise.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Exercise</h1>

    <form method="GET"  action="/exercise">
        <fieldset>
            <div class="form-group">
                <p><b>What exercise did you do today?</b></p>
                <input list="exercise" autocomplete="off" autofocus class="form-control" name="exercise" placeholder="Exercise" type="text"/>
                <datalist id="exercise">
                    @foreach($exerciseList as $exercise)
                        <option value="{{$exercise}}">
                    @endforeach
                </datalist>
            </div>

            <div class="form-group">
                <button class="btn btn-default" type="submit">Add</button>
            <div>

            <div>
                <br><p><b>Make changes to the list of exercise: <br> <a href='/newexercise'>Add exercise</a> | <a href='/deleteexercise'>Delete exercise</a></b></p>
            </div>
        </fieldset>
    </form>

    <h4>Exercises you did today:- </h4>
    <br>

    @if(count($users->exercises)==0)
        <h5>Nothing yet!</5>
    @else

        <table>
        <tr>
            <th><div class="underline">Exercise</div></th>
            <th><div class="underline">Calories</div></th>
        </tr>

        @foreach($users->exercises as $exercise)
            <tr>
                <td>{{$exercise->exercise}}</td>
                <td>{{$exercise->calories}}</td>
            </tr>
        @endforeach
        </table>
        <br><br>
    @endif
@endsection
