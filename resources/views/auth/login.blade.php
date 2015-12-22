@extends('app')

@section('content')

<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button name="login" type="submit">Login</button>
    </div>

    <a href='/auth/register'> Sign up </a>
</form>


@stop
