<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CyberCrimeInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CaseStatusController extends Controller
{

    protected CyberCrimeInfo $cyberCrimeInfo;

    public function __construct(CyberCrimeInfo $_cyberCrimeInfo)
    {
        $this->cyberCrimeInfo = $_cyberCrimeInfo;
    }

    public function index(Request $request)
    {
        $statusType = $request->statusType ?? null;

        $query = $this->cyberCrimeInfo;
        if ($statusType == 'pending-arrest') {
            $query = $this->cyberCrimeInfo->whereNull('FIR_STATUS')->orWhere('FIR_STATUS', '');
        } elseif ($statusType == 'pending-chargesheet') {
            $query = $this->cyberCrimeInfo->whereIn('FIR_STATUS', ['UI Cases', 'Under Investigation']);
        } elseif ($statusType == 'charged') {
            $query = $this->cyberCrimeInfo->whereIn('FIR_STATUS', ['Chargesheet Created', 'Chargesheeted']);
        } elseif ($statusType == 'under-trial') {
            $query = $this->cyberCrimeInfo->whereIn('FIR_STATUS', ['Under Trial', 'Pending Trial', 'PT Cases']);
        } elseif ($statusType == 'closed') {
            $query = $this->cyberCrimeInfo->whereIn('FIR_STATUS', ['Disposal', 'Disposed Of', 'Quashed']);
        }

        $cyberCrimeRecords = $query->paginate(50);

        return view('pages.case-status.pe', compact('cyberCrimeRecords'));
    }
    public function peFirNo(Request $request)
    {
        return view('pages.case-status.pe-fir-no');
    }

    public function peFirKyc(Request $request)
    {
        return view('pages.case-status.pe-fir-kyc');
    }

    public function peFirCdr(Request $request)
    {
        return view('pages.case-status.pe-fir-cdr');
    }
}
