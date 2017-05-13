@extends('layouts.master')

@section('content')

    <h1>Register</h1><br>

    <form method="POST" id='register' action="{{ route('register') }}">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <label for="name">* Name</label><br>
                <input id="name" type="text" autocomplete="off" autofocus class="form-control" name="name" value="{{ old('name') }}"><br><br>

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
                <label for="password">* Password (min: 6)</label><br>
                <input id="password" type="password" autocomplete="off" class="form-control" name="password"><br><br>

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

            <div class="form-group">
                <label for="password-confirm">* Confirm Password</label><br>
                <input id="password-confirm" type="password" autocomplete="off" class="form-control" name="password_confirmation"><br><br>

                @if($errors->get('password_confirmation'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->get('password_confirmation') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Register</button><br><br>
        </fieldset>
    </form>
@endsection
