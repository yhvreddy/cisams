<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInformation;
use App\Models\TotalPOH;
use App\Mail\GenerateRequestMail;
use App\Mail\CDRGenerateRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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

    public function firConversions($listType, $basedOn, Request $request)
    {

        $listName = 'Total Complaints';
        $firConversionListing = $this->additionalInformation
            ->join('Sample_Total_POH', 'Sample_Total_POH.NCRP Ack No', '=', 'Sample_Additional_Information.Acknowledgement_No')
            ->select('Sample_Additional_Information.District_Name', DB::raw('COUNT(Sample_Additional_Information.Acknowledgement_No) as total_cases'))
            ->groupBy('Sample_Additional_Information.District_Name');

        // Apply filters based on list type
        if ($listType == 'pending-conversions') {
            $firConversionListing->whereNotIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered', 'Closed']);
            $listName = 'Pending Conversions';
        } elseif ($listType == 'fir-converted') {
            $firConversionListing->whereIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered']);
            $listName = 'FIR Converted';
        }

        $districtWiseData = $firConversionListing->get();

        $labels = [];
        $casesData = [];
        $colors = []; // Array to hold dynamic colors
        $districtWiseUrls = [];
        foreach ($districtWiseData as $data) {
            $labels[] = $data->District_Name; // District names for the graph labels
            $casesData[] = $data->total_cases; // Case count for each district
            $districtWiseUrls[] =
                route('fir-conversions.list.district.type', [
                    'district' => $data->District_Name,
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
        $firConversionListing = $this->additionalInformation
            ->join('Sample_Total_POH', 'Sample_Total_POH.NCRP Ack No ', 'Sample_Additional_Information.Acknowledgement_No')
            ->where('Sample_Additional_Information.District_Name', $district)
            ->select('Sample_Additional_Information.*', 'Sample_Total_POH.Amount Lost as amount_lost', 'Sample_Total_POH.Amount POH as amount_poh');
        if ($listType == 'pending-conversions') {
            $firConversionListing->whereNotIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered', 'Closed']);
            $listName = 'Pending Conversions';
        } elseif ($listType == 'fir-converted') {
            $firConversionListing->whereIn('Sample_Additional_Information.status', ['Registered', 'FIR Registered']);
            $listName = 'FIR Converted';
        }
        $firConversionListing = $firConversionListing->paginate(20);

        return view('pages.fir-conversions.list', compact('firConversionListing', 'listName', 'district', 'listType', 'basedOn'));
    }

    public function tcYes($district, $listType, Request $request)
    {
        return view('pages.fir-conversions.tc-yes', compact('district', 'listType'));
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

        if ($request->type == 'cdr') {
            Mail::to($request->email)->send(new CDRGenerateRequestMail());
        } else {
            Mail::to($request->email)->send(new GenerateRequestMail()); // send email
        }
        dd("===");
        return redirect()->back()->with('success', 'Email Sent Successfully!');
    }
}
