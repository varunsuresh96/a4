@extends('layouts.master')

@section('content')

    <h1>Register</h1><br>

    <form method="POST" id='register' action="{{ route('register') }}">

        {{ csrf_field() }}
        <fieldset>

        <div class="form-group">
        <label for="name">* Name</label><br>
        <input id="name" type="text" autocomplete="off" autofocus class="form-control" name="name" value="{{ old('name') }}">
        @if($errors->has('name'))
            <span class="help-block">
                <div class="error">{{ $errors->first('name') }}</div>
            </span>
        @endif
      </div>

        <div class="form-group">
        <label for="password">* Password (min: 6)</label><br>
        <input id="password" type="password" autocomplete="off" class="form-control" name="password">
        @if ($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
      </div>

        <div class="form-group">
        <label for="password-confirm">* Confirm Password</label><br>
        <input id="password-confirm" type="password" autocomplete="off" class="form-control" name="password_confirmation">
      </div>
        <br>
        <button type="submit" class="btn btn-primary">Register</button>

      </fieldset>
        </form>

@endsection
