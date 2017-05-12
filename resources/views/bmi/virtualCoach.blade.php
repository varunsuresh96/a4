

{{-- /resources/views/bmi/virtualCoach.blade.php --}}
@extends('layouts.master')

@section('content')

<h4>Hello <b>{{$user}}</b>! I am your virtual coach and I am here to help you meet your goals !</h4>

<div class="boxed">
<h3>Food</h3>
<div class="info">Based on our analysis, you have
 @if($caloriesRequired>$caloriesConsumed)
not yet consumed the required number of calories for today. You still need to consume {{$caloriesLeft1}} to meet your daily
requirement.
<br><br>Don't worry about it ! Might I suggest a couple of tips to help you consume the required calories to meet your goals?</div>
<br><div class="underline" class="info">How about you try these techniques:-</div>
<br><div class="info">1) Eating five to six small meals a day will help you consume more calories.
<br>2) To gain weight in a healthful way, you should focus on eating nutrient-dense foods.
<br>3) Consuming foods such as soft drinks, candy, chips and cookies is not a smart way to increase calories. They do not help build muscle, repair tissues or strengthen bones like nutrient-rich foods do.
<br>4) Drink your calories with great shakes and juices. </div>
@endif

@if($caloriesRequired<$caloriesConsumed AND $caloriesRequired+500>$caloriesConsumed)
<div class="info">consumed the required number of calories for the day. Good job ! </div>
@endif

@if($caloriesRequired+500<$caloriesConsumed)
<div class="info">consumed a considerably higher number of calories than that is required. You might want to watch out on what you eat for the rest of the day since
you are already above your required calorie intake! </div>
@endif
</div>
<br>
<div class="boxed">
<h3>Exercise</h3>
<div class="info">Based on our analysis, you have
 @if($caloriesRequired>$caloriesBurned)
not yet burned the required number of calories for today. You still need to burn {{$caloriesLeft2}} to meet your daily
requirement.
<br><br>Don't worry about it ! Might I suggest a couple of tips to help you burn the required calories to meet your goals?</div>
<br><div class="underline" class="info">How about you try these techniques:-</div>
<br><div class="info">How about you try these techniques:-
<br>1) If at all possible, exercise first thing in the morning.
<br>2) Give yourself credit for the smallest effort.
<br>3) Start slow and gradually increase the intensity.
<br>4) Try to incorperate your interests and passions into your exercise routine (Eg.dancing, trekking, sports).</div>
@endif

@if($caloriesRequired<$caloriesBurned AND $caloriesRequired+500>$caloriesBurned)
<div class="info">burned the required number of calories for the day. Good job ! </div>
@endif

@if($caloriesRequired+500<$caloriesConsumed)
<div class="info">burned a considerably higher number of calories than that is required. Slow down there buddy ! You might want to stop working out
for the day since you are already above the required calories to be burned! <div>
@endif

</div>
<br>
<div class="boxed">
<h4>Good luck for the rest of the day :) </h4>
</div>
<br>
@endsection
