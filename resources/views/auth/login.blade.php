
{{-- /resources/views/auth/login.blade.php --}}

@extends('layouts.master')
@section('content')

    <h1>Login</h1><br>
    <form id='login' method="POST" action="/login">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <label for="name">*Username</label><br>
                <input id="name" type="text" autocomplete="off"  autofocus class="form-control" name="name" value="{{ old('name') }}">

                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label><br>
                <input id="password" type="password" autocomplete="off" class="form-control" name="password">

                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <div class="form-group">
                  <br>Don't have an account? <a href='/register'>Register here!</a>
            </div>
        </fieldset>
    </form>
@endsection
