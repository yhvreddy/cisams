<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInformation;
use App\Models\TotalPOH;

class FIRConversionsController extends Controller
{

    protected AdditionalInformation $additionalInformation;
    protected TotalPOH $totalPoh;

    public function __construct(
        AdditionalInformation $_additionalInformation,
        TotalPOH  $_totalPoh
    ) {
        $this->additionalInformation = $_additionalInformation;
        $this->totalPoh = $_totalPoh;
    }

    public function index(Request $request)
    {
        $allAdditionalInfo = $this->additionalInformation->limit(50)->get();
        $convertedAdditionalInfo = $this->additionalInformation->whereIn('status', ['Registered', 'FIR Registered'])->limit(50)->get();
        $pendingAdditionalInfo = $this->additionalInformation->whereNotIn('status', ['Registered', 'FIR Registered', 'Closed'])->limit(20)->get();
        return view('pages.fir-conversions.index', compact('allAdditionalInfo', 'convertedAdditionalInfo', 'pendingAdditionalInfo'));
    }

    public function tcYes(Request $request)
    {
        return view('pages.fir-conversions.tc-yes');
    }

    public function roPending(Request $request)
    {
        return view('pages.fir-conversions.ro-pending');
    }

    public function ufUpdate(Request $request)
    {
        return view('pages.fir-conversions.uf-update');
    }
    public function urUpdate(Request $request)
    {
        return view('pages.fir-conversions.ur-update');
    }

    public function fcYes(Request $request)
    {
        return view('pages.fir-conversions.fc-yes');
    }

    public function sroPending(Request $request)
    {
        return view('pages.fir-conversions.sro-pending');
    }

    public function evNo(Request $request)
    {
        return view('pages.fir-conversions.ev-no');
    }

    public function egNo(Request $request)
    {
        return view('pages.fir-conversions.eg-no');
    }

    public function whatsAppPending(Request $request)
    {
        return view('pages.fir-conversions.whatsapp-pending');
    }
}
