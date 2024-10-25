<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInformation;
use App\Models\TotalPOH;
use App\Models\CyberCrimeInfo;
use App\Mail\GenerateRequestMail;
use App\Mail\CDRGenerateRequestMail;
use App\Mail\WhatsAppRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class FIRConversionsController extends Controller
{

    protected AdditionalInformation $additionalInformation;
    protected TotalPOH $totalPoh;
    protected CyberCrimeInfo $cyberCrimeInfo;

    public function __construct(
        AdditionalInformation $_additionalInformation,
        TotalPOH  $_totalPoh,
        CyberCrimeInfo $_cyberCrimeInfo
    ) {
        $this->additionalInformation = $_additionalInformation;
        $this->totalPoh = $_totalPoh;
        $this->cyberCrimeInfo = $_cyberCrimeInfo;
    }

    public function index(Request $request)
    {
        $allAdditionalInfo = $this->totalPoh->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->paginate(50);

        $convertedAdditionalInfo = $this->totalPoh->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->whereIn('Sample_Total_POH.status', ['Registered', 'FIR Registered'])
            ->paginate(50);

        $pendingAdditionalInfo = $this->totalPoh->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh')
            ->whereNotIn('Sample_Total_POH.status', ['Registered', 'FIR Registered', 'Closed'])->paginate(50);
        return view('pages.fir-conversions.index', compact('allAdditionalInfo', 'convertedAdditionalInfo', 'pendingAdditionalInfo'));
    }

    public function firConversions($listType, $basedOn, Request $request)
    {
        $listName = 'Total Complaints';
        $firConversionListing = $this->totalPoh
            ->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No', '=', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Total_POH.District', DB::raw('COUNT(*) as total_cases'))
            ->where(function ($query) {
                $query->whereNotNull(DB::raw('TRY_CAST([Sample_Total_POH].[District] AS VARCHAR)'))
                    ->orWhere(DB::raw('TRY_CAST([Sample_Total_POH].[District] AS VARCHAR)'), '!=', 0);
            })
            ->groupBy('Sample_Total_POH.District');

        if ($basedOn == 'amount-lost-more-than-one-lakh') {
            $firConversionListing->whereRaw("TRY_CAST(Sample_Total_POH.[Amount Lost] AS INT) > 100000");
        }

        if ($basedOn == 'poh-more-than-25000') {
            $firConversionListing->whereRaw("TRY_CAST(Sample_Total_POH.[Amount POH] AS INT) > 25000");
        }

        // Apply filters based on list type
        if ($listType == 'pending-conversions') {
            $firConversionListing->whereNotIn('Sample_Total_POH.status', ['Registered', 'FIR Registered', 'Closed']);
            $listName = 'Pending Conversions';
        } elseif ($listType == 'fir-converted') {
            $firConversionListing->whereIn('Sample_Total_POH.status', ['Registered', 'FIR Registered']);
            $listName = 'FIR Converted';
        }

        $districtWiseData = $firConversionListing->get();

        $labels = [];
        $casesData = [];
        $colors = []; // Array to hold dynamic colors
        $districtWiseUrls = [];
        foreach ($districtWiseData as $data) {
            $labels[] = $data->District; // District names for the graph labels
            $casesData[] = $data->total_cases; // Case count for each district
            $districtWiseUrls[] =
                route('fir-conversions.list.district.type', [
                    'district' => $data->District,
                    'listType' => $listType,
                    'basedOn' => $basedOn
                ]);
        }

        // Generate dynamic colors for each district
        $colors = array_map(function () {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random hex color
        }, $labels);

        return view('pages.fir-conversions.district-links', compact('listName', 'listType', 'basedOn', 'labels', 'casesData', 'colors', 'districtWiseUrls'));
    }

    public function firConversionDistrict($district, $listType, $basedOn, Request $request)
    {
        $listName = 'Total Complaints';
        $firConversionListing = $this->totalPoh
            ->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->join('FIR_Conversions', 'FIR_Conversions.Acknowledgement_No', 'Sample_Total_POH.NCRP Ack No ')
            ->where('Sample_Total_POH.District', $district);


        if ($basedOn == 'amount-lost-more-than-one-lakh') {
            $firConversionListing->whereRaw("TRY_CAST(Sample_Total_POH.[Amount Lost] AS INT) > 100000");
        }

        if ($basedOn == 'poh-more-than-25000') {
            $firConversionListing->whereRaw("TRY_CAST(Sample_Total_POH.[Amount POH] AS INT) > 25000");
        }

        $firConversionListing->select(
            'Sample_Total_POH.S No as sno',
            'Sample_Total_POH.NCRP Ack No  as NCRP_No',
            'Sample_Additional_Information.Complaint_Date',
            'Sample_Additional_Information.Category as Mo',
            'Sample_Total_POH.Amount Lost as amount_lost',
            'Sample_Total_POH.Amount POH as amount_poh',
            'Sample_Total_POH.Status as POH_Status',
            'Sample_Additional_Information.Status as AI_Status',
            'FIR_Conversions.FIR_NO as FIR_NO'
        );

        if ($listType == 'pending-conversions') {
            $firConversionListing->whereNotIn('Sample_Total_POH.status', ['Registered', 'FIR Registered', 'Closed']);
            $listName = 'Pending Conversions';
        } elseif ($listType == 'fir-converted') {
            $firConversionListing
                ->whereIn('Sample_Total_POH.status', ['Registered', 'FIR Registered']);
            $firConversionListing = $firConversionListing->paginate(20);
            $listName = 'FIR Converted';
            return view('pages.fir-conversions.fir_converted_list', compact('firConversionListing', 'listName', 'district', 'listType', 'basedOn'));
        }

        $firConversionListing = $firConversionListing->paginate(20);
        return view('pages.fir-conversions.list', compact('firConversionListing', 'listName', 'district', 'listType', 'basedOn'));
    }

    public function tcYes($district, $listType, Request $request)
    {
        $firConversion = $this->totalPoh
            ->leftJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')->where('Sample_Total_POH.NCRP Ack No ', $request->ncrpId)->first();
        $cyberCrimeInfo = DB::table('FIR_Conversions')
            ->leftJoin('Cyber_Crime_Info', DB::raw("CONCAT(Cyber_Crime_Info.FIR_NO, '/', Cyber_Crime_Info.YEAR)"), '=', 'FIR_Conversions.FIR_NO')
            ->select('FIR_Conversions.FIR_NO as FIR_ID', 'Cyber_Crime_Info.*')
            ->whereRaw("CONCAT(Cyber_Crime_Info.FIR_NO, '/', Cyber_Crime_Info.YEAR) = ?", [$request->FIR_NO])
            // ->orderBy('Cyber_Crime_Info.FIR_ID', 'DESC')
            // ->groupBy('Cyber_Crime_Info.SEC_OF_LAW', 'FIR_Conversions.FIR_NO', 'Cyber_Crime_Info.CRIME_ID', 'Cyber_Crime_Info.ACCUSED_NO', 'Cyber_Crime_Info.FIR_NO', 'Cyber_Crime_Info.YEAR', 'Cyber_Crime_Info.CRIME_PS', 'Cyber_Crime_Info.CRIME_DISTRICT', 'Cyber_Crime_Info.CRIME_STATE', 'Cyber_Crime_Info.CRIME_MO', 'Cyber_Crime_Info.CRIME_MAJOR_HEAD', 'Cyber_Crime_Info.CRIME_PROPERTY_LOST', 'Cyber_Crime_Info.OFFENCE_PHONE', 'Cyber_Crime_Info.OFFENCE_EMAIL', 'Cyber_Crime_Info.OFFENCE_FACEBOOK', 'Cyber_Crime_Info.OFFENCE_OTHER_SOCIAL_MEDIA', 'Cyber_Crime_Info.OFFENCE_BANK_ACCOUNT', 'Cyber_Crime_Info.OFFENCE_BANK_NAME', 'Cyber_Crime_Info.OFFENCE_BANK_STATE', 'Cyber_Crime_Info.OFFENCE_BANK_DISTRICT')
            ->get();

        if (!$cyberCrimeInfo->count()) {
            return redirect()->back()->with('error', 'FIR Not Found');
        }
        return view('pages.fir-conversions.tc-yes', compact('district', 'listType', 'cyberCrimeInfo'));
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

    public function fcYes($district, $listType, Request $request)
    {
        dd($district, $listType);
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

    public function whatsAppPending($type, Request $request)
    {
        return view('pages.fir-conversions.whatsapp-pending', compact('type'));
    }

    public function generateRequest($type, Request $request)
    {
        return view('pages.fir-conversions.generate-request', compact('type'));
    }

    public function saveGenerateRequest(Request $request)
    {
        if (!isset($request->email)) {
            return redirect()->back()->with('error', 'Email is required');
        }

        $status = false;
        if ($request->type == 'cdr') {
            $status = true;
            Mail::to($request->email)->send(new CDRGenerateRequestMail());
        } elseif ($request->type == 'whatsapp') {
            $status = true;
            Mail::to($request->email)->send(new WhatsAppRequestMail());
        } elseif ($request->type == 'soa') {
            $status = true;
            Mail::to($request->email)->send(new GenerateRequestMail()); // send email
        }

        if (!$status) {
            return redirect()->back()->with('failed', 'Invalid request to send email.');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully!');
    }
}
