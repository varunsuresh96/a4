{{-- /resources/views/bmi/foodTable.blade.php --}}
@extends('layouts.master')

@section('content')

<table style="margin: 0px auto;">
<tr>
    <th>Food</th>

</tr>
@foreach($user->foods as $food)
<tr>
    <td>{{$food->food}}</td>
</tr>

@endforeach
</table>



@endsection
