{{-- /resources/views/auth/login.blade.php --}}
@extends('layouts.master')

@section('content')

    <h1>Login</h1>

    <form id='login' method="POST" action="/login">

        {{ csrf_field() }}
        <fieldset>
        <div class="form-group">
        <label for="name">*Username</label>
        <input id="name" type="text" autocomplete="off" autofocus class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        @if($errors->has('name'))

                <div class="error">{{ $errors->first('name') }}</div>

        @endif
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" autocomplete="off" autofocus class="form-control" name="password" required>
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
