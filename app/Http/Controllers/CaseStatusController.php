<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseStatusController extends Controller
{
    public function index(Request $request) {
        return view('pages.case-status.pe');
    }
    public function peFirNo(Request $request) {
        return view('pages.case-status.pe-fir-no');
    }

    public function peFirKyc(Request $request) {
        return view('pages.case-status.pe-fir-kyc');
    }

    public function peFirCdr(Request $request) {
        return view('pages.case-status.pe-fir-cdr');
    }
}
