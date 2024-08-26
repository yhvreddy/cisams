<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FIRConversionsController extends Controller
{
    public function index(Request $request) {
        return view('pages.fir-conversions.index');
    }

    public function tcYes(Request $request) {
        return view('pages.fir-conversions.tc-yes');
    }

    public function roPending(Request $request) {
        return view('pages.fir-conversions.ro-pending');
    }

    public function ufUpdate(Request $request) {
        return view('pages.fir-conversions.uf-update');
    }
    public function urUpdate(Request $request) {
        return view('pages.fir-conversions.ur-update');
    }

    public function fcYes(Request $request) {
        return view('pages.fir-conversions.fc-yes');
    }

    public function sroPending(Request $request) {
        return view('pages.fir-conversions.sro-pending');
    }

    public function evNo(Request $request) {
        return view('pages.fir-conversions.ev-no');
    }

    public function egNo(Request $request) {
        return view('pages.fir-conversions.eg-no');
    }

    public function whatsAppPending(Request $request) {
        return view('pages.fir-conversions.whatsapp-pending');
    }
}
