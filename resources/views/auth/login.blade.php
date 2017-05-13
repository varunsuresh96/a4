
{{-- /resources/views/auth/login.blade.php --}}

@extends('layouts.master')
@section('content')

    <h1>Login</h1><br>
    <form id='login' method="POST" action="/login">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <label for="name">*Username</label><br>
                <input id="name" type="text" autocomplete="off"  autofocus class="form-control" name="name" value="{{ old('name') }}"><br><br>

                @if($errors->get('name'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label><br>
                <input id="password" type="password" autocomplete="off" class="form-control" name="password">

                @if($errors->get('password'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <div class="form-group">
                  <br>Don't have an account? <a href='/register'>Register here!</a>
            </div>
        </fieldset>
    </form>
@endsection
