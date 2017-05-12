{{-- /resources/views/bmi/exerciseDeleted.blade.php --}}
@extends('layouts.master')

@section('content')
    <div class="alert alert-success"><h4>'{{$exercise->exercise}}' has been deleted!</h4></div>
    <h5><b>Note</b>: Once an exercise has been deleted, it can no longer be added to or viewed in your list of exercises performed.</h5>
@endsection
