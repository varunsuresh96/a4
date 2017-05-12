{{-- /resources/views/bmi/food.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Nutrition</h1>

    <form method="GET" id='nutrition' action="/food">
        <fieldset>

            <div class="form-group">
                <p><b>What did you eat today?</b></p>
                <input list="food" autocomplete="off" autofocus class="form-control" name="food" placeholder="Food Item" type="text"/>
                <datalist id="food">
                  @foreach($foodList as $food)
                      <option value="{{$food}}">
                  @endforeach
                </datalist>
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">Add</button>
            <div>
            <br><p><b>Make changes to the list of food items: <br> <a href='/newfood'>Add food item</a> | <a href='/deletefood'>Delete food item</a></b></p>
          </div>
          </fieldset>
    </form>

    <h4>Things you ate today:- </h4>
    <br>
    @if(count($users->foods)==0)
      <h5>Nothing yet!</5>
    @else

    <table>
    <tr>
        <th>Nutrition</th>
        <th>Calories</th>

    </tr>
      @foreach($users->foods as $food)
    <tr>
      <td>{{$food->food}}</td>
      <td>{{$food->calories}}</td>
      </tr>
    @endforeach
</table>
<br><br>
@endif

@endsection
