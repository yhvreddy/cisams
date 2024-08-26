@extends('layouts.auth-app')

@section('title', 'Login')

@section('styles')
@endsection

@section('content')
    <div class="login-box">
        <img src="{{url('assets/images/logo.png')}}" alt="CISAMS Logo" >
        <h1 class="login-title">LOGIN</h1>
        <p class="login-subtitle">Cybercrime Investigation Support, Analysis and Monitoring System</p>

        <form action="{{route('login.access')}}" method="post">
            @csrf

            <div class="input-group">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" placeholder="Enter User Name" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button type="submit" class="login-button">LOGIN</button>
        </form>
    </div>
@endsection
