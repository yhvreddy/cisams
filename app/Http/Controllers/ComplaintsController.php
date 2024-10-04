<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalInformation;

class ComplaintsController extends Controller
{
    protected AdditionalInformation $additionalInformation;

    public function __construct(
        AdditionalInformation $_additionalInformation,
    ) {
        $this->additionalInformation = $_additionalInformation;
    }

    public function financial(Request $request)
    {
        $complaintData = $this->additionalInformation
            ->selectRaw("
                category,
                COUNT(*) AS total_complaints,
                SUM(CASE WHEN status IN ('FIR Registered', 'Registered') THEN 1 ELSE 0 END) AS fir_conversion,
                SUM(CASE WHEN status IN ('Under process', 'Reopen') THEN 1 ELSE 0 END) AS fir_pending
            ")
            ->whereIn('category', ['Online Financial Fraud', 'Online Gambling / Betting', 'Cryptocurrency Crime'])
            ->groupBy('category')
            ->get();

        // Prepare data for the graph
        $labels = [];
        $datasets = [];
        $complaintsData = [];
        $firConversionData = [];
        $firPendingData = [];
        $backgroundColors = [];

        foreach ($complaintData as $data) {
            $labels[] = $data->category; // Category names (labels for X-axis)

            $complaintsData[] = $data->total_complaints; // Data for Complaints
            $firConversionData[] = $data->fir_conversion; // Data for FIR Conversion
            $firPendingData[] = $data->fir_pending; // Data for FIR Pending

            // Random color generator for background colors (optional)
            $backgroundColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Dynamic colors
        }

        // Create datasets for the graph
        $datasets = [
            [
                'label' => 'Complaints',
                'data' => $complaintsData,
                'backgroundColor' => '#375CE1',
                'borderRadius' => 10
            ],
            [
                'label' => 'FIR Conversion',
                'data' => $firConversionData,
                'backgroundColor' => '#C6D2FF',
                'borderRadius' => 10
            ],
            [
                'label' => 'FIR Pending',
                'data' => $firPendingData,
                'backgroundColor' => '#092081',
                'borderRadius' => 10
            ]
        ];

        return view('pages.complaints.financial', compact('labels', 'datasets'));
    }
    public function nonFinancial(Request $request)
    {
        $complaintData = $this->additionalInformation
            ->selectRaw("
                category,
                COUNT(*) AS total_complaints,
                SUM(CASE WHEN status IN ('FIR Registered', 'Registered') THEN 1 ELSE 0 END) AS fir_conversion,
                SUM(CASE WHEN status IN ('Under process', 'Reopen') THEN 1 ELSE 0 END) AS fir_pending
            ")
            ->whereNotIn('category', ['Online Financial Fraud', 'Online Gambling / Betting', 'Cryptocurrency Crime'])
            ->groupBy('category')
            ->get();

        // Prepare data for the graph
        $labels = [];
        $datasets = [];
        $complaintsData = [];
        $firConversionData = [];
        $firPendingData = [];
        $backgroundColors = [];

        foreach ($complaintData as $data) {
            $labels[] = $data->category; // Category names (labels for X-axis)

            $complaintsData[] = $data->total_complaints; // Data for Complaints
            $firConversionData[] = $data->fir_conversion; // Data for FIR Conversion
            $firPendingData[] = $data->fir_pending; // Data for FIR Pending

            // Random color generator for background colors (optional)
            $backgroundColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Dynamic colors
        }

        // Create datasets for the graph
        $datasets = [
            [
                'label' => 'Complaints',
                'data' => $complaintsData,
                'backgroundColor' => '#375CE1',
                'borderRadius' => 10
            ],
            [
                'label' => 'FIR Conversion',
                'data' => $firConversionData,
                'backgroundColor' => '#C6D2FF',
                'borderRadius' => 10
            ],
            [
                'label' => 'FIR Pending',
                'data' => $firPendingData,
                'backgroundColor' => '#092081',
                'borderRadius' => 10
            ]
        ];


        // dd($complaints, $firConversion, $firPending, $sets);
        return view('pages.complaints.non-financial', compact('labels', 'datasets'));
    }
}
