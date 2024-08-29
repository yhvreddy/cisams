<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Traits\HandlesCustomExceptions;
use App\Enums\AccountStatus;

class HomeController extends Controller
{
    use HandlesCustomExceptions;

    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }

        return view('pages.auth.login');
    }

    public function loginAccess(LoginRequest $request)
    {
        try {
            $credentials = $this->getCredentials($request);

            // Attempt to log the user in
            if (Auth::attempt($credentials)) {

                // Redirect based on user role
                return redirect()->route('home');
            }

            // If unsuccessful, redirect back with input and errors
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        } catch (Exception $e) {
            // Use the custom exception handler
            return $this->handleException($e, 'login');
        }
    }

    protected function getCredentials(LoginRequest $request)
    {
        $loginId = $request->input('username');
        $fieldType = filter_var($loginId, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $fieldType  =>  $loginId,
            'password'  =>  $request->input('password'),
            'status'    =>  AccountStatus::ACTIVATE
        ];
    }

    public function index(Request $request)
    {
        return view('pages.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
