@extends('layouts.auth-app')

@section('title', 'Login')

@section('styles')
@endsection

@section('content')
    <div class="login-box">
        <img src="{{ url('assets/images/logo.png') }}" alt="CISAMS Logo">
        {{-- <h1 class="login-title">LOGIN</h1> --}}
        <p class="login-subtitle mb-3 mt-3">Cybercrime Investigation Support, Analysis and Monitoring System</p>

        <form id="loginForm" action="{{ route('login.access') }}" class="mt-3" method="post">
            @csrf

            <div class="input-group">
                <label for="username">User Name</label>
                <input type="text" id="username" value="{{ old('username') }}" name="username"
                    placeholder="Enter User Name" required />
                <small id="username-error" class="error-message text-danger"></small>
                @if ($errors->has('username'))
                    <small class="text-danger">{{ $errors->first('username') }}</small>
                @endif
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required />
                <small id="password-error" class="error-message text-danger"></small>
                @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="captcha">Captcha</label>
                <div class="row">
                    <div class="col-auto" style="height: fit-content;">
                        <div class="captcha">
                            <span>{!! Captcha::img() !!}</span>
                        </div>
                    </div>
                    <div class="col-auto" style="height: fit-content;">
                        <div class="input-group">
                            <input id="captcha" type="text" placeholder="Enter Captcha" name="captcha" />
                        </div>
                    </div>
                    <div class="col-auto" style="height: fit-content;">
                        <button type="button" class="btn btn-success refresh-cpatcha"><i
                                class="fa fa-refresh"></i></button>
                    </div>
                    @error('captcha')
                        <div class="text-danger mb-3">{{ $errors->first('captcha') }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="login-button">LOGIN</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('#username').on('keyup', function() {
            validateInput(this, '#username-error');
        });

        $('#password').on('keyup', function() {
            validateInputWithSplChar(this, '#password-error');
        });

        $('#loginForm').on('submit', function(e) {
            let isValid = true;

            if ($('#username-error').text() !== '' || $('#password-error').text() !== '') {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>
@endsection
