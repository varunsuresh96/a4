{{-- /resources/views/bmi/foodDeleted.blade.php --}}
@extends('layouts.master')

@section('content')

    <div class="alert alert-success"><h4>'{{$food->food}}' has been deleted!</h4></div>
    <h5><b>Note</b>: Once a food item has been deleted, it can no longer be added to or viewed in your list of food items consumed.</h5>
@endsection
