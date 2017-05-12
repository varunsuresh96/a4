{{-- /resources/views/bmi/deleteFood.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Delete Food</h1>


    <form method="POST" id='nutrition' action="/deletefood">
      {{ csrf_field() }}

        <fieldset>

            <div class="form-group">
              <input list="food" autocomplete="off" autofocus class="form-control" name="food" placeholder="Food Item" type="text"/>
              <datalist id="food">
                @foreach($foodList as $food)
                    <option value="{{$food}}">
                @endforeach
              </datalist>
            </div>
            @if($errors->get('food'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->get('food') as $error)
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
