{{-- /resources/views/bmi/home.blade.php --}}
@extends('layouts.master')

@section('content')
<h1>Progress Report</h1>
<div id="chartContainer" style="height: 450px; width: 100%;"></div>
<div><br><br></div>
<div id="chartContainer2" style="height: 450px; width: 100%;"></div>

<script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript">charts({{$caloriesConsumed}},{{$caloriesLeft1}},{{$caloriesBurned}},{{$caloriesLeft2}});</script>


@endsection
