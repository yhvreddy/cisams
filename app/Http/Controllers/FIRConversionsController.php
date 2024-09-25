<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInformation;
use App\Models\TotalPOH;
use App\Mail\GenerateRequestMail;
use Illuminate\Support\Facades\Mail;

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
        $allAdditionalInfo = $this->additionalInformation->join('Sample_Total_POH', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->paginate();

        $convertedAdditionalInfo = $this->additionalInformation->join('Sample_Total_POH', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->whereIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered'])
            ->paginate();

        $pendingAdditionalInfo = $this->additionalInformation->join('Sample_Total_POH', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->whereNotIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered', 'Closed'])->paginate();
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

    public function generateRequest(Request $request)
    {
        return view('pages.fir-conversions.generate-request');
    }

    public function saveGenerateRequest(Request $request)
    {
        if (!isset($request->email)) {
            return redirect()->back()->with('error', 'Email is required');
        }

        Mail::to($request->email)->send(new GenerateRequestMail());
        return redirect()->back()->with('success', 'Email Sent Successfully!');
    }
}
