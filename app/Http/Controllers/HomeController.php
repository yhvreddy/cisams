<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Traits\HandlesCustomExceptions;
use App\Enums\AccountStatus;
use App\Models\PTWarrants;

class HomeController extends Controller
{
    use HandlesCustomExceptions;

    protected PTWarrants $ptWarrants;

    public function __construct(
        PTWarrants $_ptWarrants
    ) {
        $this->ptWarrants = $_ptWarrants;
    }


    public function login(Request $request)
    {
        if (Auth::check()) {
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
            return redirect()->back()->with('failed', 'Invalid login credentials, please check once.');
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
        $ptWarrant =
            $this->ptWarrants
            ->selectRaw('
                COUNT(CASE WHEN SOURCE = ? THEN 1 END) as fir_links_count,
                COUNT(CASE WHEN SOURCE = ? THEN 1 END) as ncrp_links_count,
                COUNT(CASE WHEN PT_EXECUTED != ? THEN 1 END) as pt_warranty_executed_count,
                COUNT(CASE WHEN PT_EXECUTED = ? THEN 1 END) as pt_warranty_pending_count
            ', ['FIR', 'NCRP', 'no', 'no'])
            ->first();
        $ptWarrantCountsJSON = json_encode((array) [
            floatval($ptWarrant->fir_links_count ?? 0),
            floatval($ptWarrant->ncrp_links_count ?? 0),
            floatval($ptWarrant->pt_warranty_executed_count ?? 0),
            floatval($ptWarrant->pt_warranty_pending_count ?? 0),
        ]);
        return view('pages.home', compact('ptWarrantCountsJSON'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
