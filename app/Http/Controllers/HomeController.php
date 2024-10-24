<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Traits\HandlesCustomExceptions;
use App\Enums\AccountStatus;
use App\Models\PTWarrants;
use App\Models\LokAdalatRefundFIR;
use App\Models\AdditionalInformation;
use App\Models\TotalPOH;
use App\Models\CyberCrimeInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use HandlesCustomExceptions;

    protected PTWarrants $ptWarrants;
    protected AdditionalInformation $additionalInformation;
    protected LokAdalatRefundFIR $refundFir;
    protected TotalPOH $totalPoh;

    public function __construct(
        PTWarrants $_ptWarrants,
        AdditionalInformation $_additionalInformation,
        LokAdalatRefundFIR $_refundFir,
        TotalPOH $_totalPOH
    ) {
        $this->ptWarrants = $_ptWarrants;
        $this->additionalInformation = $_additionalInformation;
        $this->refundFir = $_refundFir;
        $this->totalPoh = $_totalPOH;
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

        // Graph 1
        $graph1Data = $this->graph1Data();
        $financialChartJson = $graph1Data['financialChartJson'] ?? [];
        $nonFinancialChartJson = $graph1Data['nonFinancialChartJson'] ?? [];
        $graphOneCountJson = $graph1Data['graphOneCountJson'] ?? [];
        $financialCategories = $graph1Data['financialCategories'] ?? [];

        // Graph 2
        $graph2Data = $this->graph2Data(2021);
        $categoryNamesJson = $graph2Data['categoryNamesJson'] ?? [];
        $monthDataJson = $graph2Data['monthDataJson'] ?? [];
        $lastThreeMonths = $graph2Data['lastThreeMonths'] ?? [];

        // Graph 3
        $firConversionData = $this->graph3Data();

        // Graph 4
        $graph4Data = $this->graph4Data();
        $cyberCrimeInfo = $graph4Data['cyberCrimeInfo'] ?? [];
        $cyberCrimeInfoMaxCount = $graph4Data['cyberCrimeInfoMaxCount'] ?? [];

        // Graph 5
        $ptWarrantCountsJSON = $this->graph5Data();

        // Graph 6
        $refundData = $this->graph6Data();

        return view('pages.home', compact('ptWarrantCountsJSON', 'graphOneCountJson', 'nonFinancialChartJson', 'financialChartJson', 'categoryNamesJson', 'monthDataJson', 'lastThreeMonths', 'firConversionData', 'refundData', 'cyberCrimeInfo', 'cyberCrimeInfoMaxCount'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function graph1Data()
    {
        $financialCategories = [
            'Online Financial Fraud',
            'Online Gambling / Betting',
            'Cryptocurrency Crime'
        ];

        $graphOneCount = $this->additionalInformation
            ->selectRaw("COUNT(CASE WHEN Category IN (?, ?, ?) THEN 1 END) as financial_count, COUNT(CASE WHEN Category NOT IN (?, ?, ?) THEN 1 END) as non_financial_count", [
                'Online Financial Fraud',
                'Online Gambling / Betting',
                'Cryptocurrency Crime',
                'Online Financial Fraud',
                'Online Gambling / Betting',
                'Cryptocurrency Crime'
            ])
            ->first();

        // Extract results into an array or use as needed
        $graphOneCountJson = json_encode([
            floatval($graphOneCount->financial_count ?? 0),
            floatval($graphOneCount->non_financial_count ?? 0)
        ]);

        $nonFinancialChartJson = json_encode([
            floatval($graphOneCount->non_financial_count ?? 0),
            floatval($graphOneCount->financial_count ?? 0)
        ]);

        $financialChartJson = json_encode([
            floatval($graphOneCount->financial_count ?? 0),
            floatval($graphOneCount->non_financial_count ?? 0)
        ]);

        return ['financialChartJson' => $financialChartJson, 'nonFinancialChartJson' => $nonFinancialChartJson, 'graphOneCountJson' => $graphOneCountJson, 'financialCategories' => $financialCategories];
    }

    protected function graph2Data($moYear = 2021)
    {

        // Calculate the starting date based on the manually assigned year
        $startDate = Carbon::create($moYear, Carbon::now()->month, 1)->subMonths(3)->startOfMonth();
        $endDate = Carbon::create($moYear, Carbon::now()->month, 1)->endOfMonth();

        // Calculate the current month and the last three months
        $currentMonth = Carbon::now()->month;
        $threeMonthsAgo = Carbon::now()->subMonths(2)->month;
        $twoMonthsAgo = Carbon::now()->subMonth()->month;

        // Fetch data for the last three months, grouped by category
        $categoryData = $this->additionalInformation
            ->selectRaw('Category, MONTH(Incident_Date) as month, COUNT(*) as count')
            // ->where('Incident_Date', '>=', Carbon::now()->subMonths(3)->startOfMonth())
            // ->whereBetween('Incident_Date', [$startDate, $endDate])  // Use manual start and end date
            ->whereYear('Incident_Date', $moYear)
            ->whereIn(DB::raw('MONTH(Incident_Date)'), [$currentMonth, $twoMonthsAgo, $threeMonthsAgo])
            ->groupBy('Category', 'incident_date')
            ->orderBy('incident_date', 'asc')
            ->get();

        // dd($categoryData->toArray());

        // Step 1: Extract the category names && Remove duplicate categories
        $categoryExtractedNames = $categoryData->pluck('Category')->toArray();
        $categoryNames = array_values(array_unique($categoryExtractedNames));

        // Get the names of the last 3 months dynamically
        $lastThreeMonths = [
            Carbon::now()->subMonths(2)->format('F'),  // Two months ago
            Carbon::now()->subMonths(1)->format('F'),  // One month ago
            Carbon::now()->format('F')                 // Current month
        ];

        // Initialize $monthlyData array dynamically
        $monthlyData = [
            $lastThreeMonths[0] => [], // Two months ago
            $lastThreeMonths[1] => [], // One month ago
            $lastThreeMonths[2] => []  // Current month
        ];

        // Prepare populate monthly data
        foreach ($categoryData as $data) {
            // Assign counts to the correct month
            $monthName = Carbon::createFromDate(null, $data->month, 1)->format('F');
            if ($monthName == $lastThreeMonths[0]) {
                $monthlyData[$lastThreeMonths[0]][] = $data->count;
            } elseif ($monthName == $lastThreeMonths[1]) {
                $monthlyData[$lastThreeMonths[1]][] = $data->count;
            } elseif ($monthName == $lastThreeMonths[2]) {
                $monthlyData[$lastThreeMonths[2]][] = $data->count;
            }
        }

        // Fill missing categories with 0 for months that don't have data
        foreach ($categoryNames as $category) {
            foreach ($lastThreeMonths as $month) {
                if (!isset($monthlyData[$month][$category])) {
                    $monthlyData[$month][$category] = 0;
                }
            }
        }

        // Convert to JSON for Blade view
        $categoryNamesJson = json_encode($categoryNames);
        $monthDataJson = [];
        foreach ($lastThreeMonths as $month) {
            $monthDataJson[$month] = json_encode(array_values($monthlyData[$month]));
        }

        return ['categoryNamesJson' => $categoryNamesJson, 'monthDataJson' => $monthDataJson, 'lastThreeMonths' => $lastThreeMonths];
    }

    protected function graph5Data()
    {
        $ptWarrant =
            $this->ptWarrants
            ->selectRaw("
                COUNT(CASE WHEN SOURCE = 'FIR' THEN 1 END) AS fir_links_count,
                COUNT(CASE WHEN SOURCE IN ('NCRP', 'CFCFRMS') THEN 1 END) AS ncrp_links_count,
                COUNT(CASE WHEN PT_EXECUTED = 'Yes' THEN 1 END) AS pt_warranty_executed_count,
                COUNT(CASE WHEN PT_EXECUTED = 'No' THEN 1 END) AS pt_warranty_pending_count
            ")
            ->first();
        $ptWarrantCountsJSON = json_encode((array) [
            floatval($ptWarrant->fir_links_count ?? 0),
            floatval($ptWarrant->ncrp_links_count ?? 0),
            floatval($ptWarrant->pt_warranty_executed_count ?? 0),
            floatval($ptWarrant->pt_warranty_pending_count ?? 0),
        ]);

        return $ptWarrantCountsJSON; // Return JSON for Blade view
    }

    protected function graph6Data()
    {
        $refundData = $this->refundFir
            ->select(
                '457 CrPC (Annexure-I)_Petition filed by Victim in court Date (DD/MM/YYYY) as petition_filed_victim_court_date',
                'Annexure-III_Court Order Received Date (DD/MM/YYYY) as court_order_received_date'
            )
            ->get();
        $refundOrderPending = 0;
        $refundOrderReceived = 0;
        $refundPetitionPending = 0;
        $refundPetitionFiled = 0;
        $refundTotalCases = 0;
        foreach ($refundData as $key => $refund) {
            if (!empty($refund->petition_filed_victim_court_date)) {
                $refundPetitionFiled = $refundPetitionFiled + 1;
            } elseif (empty($refund->petition_filed_victim_court_date)) {
                $refundPetitionPending = $refundPetitionPending + 1;
            }

            if (empty($refund->court_order_received_date)) {
                $refundOrderPending = $refundOrderPending + 1;
            } elseif (!empty($refund->court_order_received_date)) {
                $refundOrderReceived = $refundOrderReceived + 1;
            }
        }

        $refundTotalCases = $refundOrderPending + $refundOrderReceived + $refundPetitionFiled + $refundPetitionPending;
        $refundData = [
            'refundTotalCases' => $refundTotalCases,
            'refundOrderPending' => $refundOrderPending,
            'refundOrderReceived'   =>  $refundOrderReceived,
            'refundPetitionFiled'   =>  $refundPetitionFiled,
            'refundPetitionPending' => $refundPetitionPending
        ];

        return $refundData;
    }

    public function graph3Data()
    {

        // Get FIR Converted data where Amount Lost > 1 Lakh and POH > 25000
        $firConvertedData = DB::table('Sample_Total_POH')
            ->leftJoin('Sample_Additional_Information', 'Sample_Additional_Information.Acknowledgement_No', '=', 'Sample_Total_POH.NCRP Ack No')
            ->select(
                DB::raw('
                    SUM(CASE WHEN TRY_CAST(Sample_Total_POH.[Amount Lost] AS INT) > 100000 THEN 1 ELSE 0 END) as amount_lost_fir_converted,
                    SUM(CASE WHEN TRY_CAST(Sample_Total_POH.[Amount POH] AS INT) > 25000 THEN 1 ELSE 0 END) as poh_fir_converted
                ')
            )
            ->whereIn('Sample_Total_POH.status', ['Registered', 'FIR Registered'])
            // ->whereNotNull('Sample_Additional_Information.District_Name')
            ->first();

        // Get Pending Conversion data where Amount Lost > 1 Lakh and POH > 25000
        $pendingConversionData = DB::table('Sample_Total_POH')
            ->leftJoin('Sample_Additional_Information', 'Sample_Additional_Information.Acknowledgement_No', '=', 'Sample_Total_POH.NCRP Ack No')
            ->select(
                DB::raw('
                    SUM(CASE WHEN TRY_CAST([Amount Lost] AS INT) > 100000 THEN 1 ELSE 0 END) as amount_lost_pending_conversion,
                    SUM(CASE WHEN TRY_CAST(Sample_Total_POH.[Amount POH] AS INT) > 25000 THEN 1 ELSE 0 END) as poh_pending_conversion
                ')
            )
            ->whereNotIn('Sample_Total_POH.status', ['Registered', 'FIR Registered', 'Closed'])
            // ->whereNotNull('Sample_Additional_Information.District_Name')
            ->first();

        $totalComplaintsAmountLost = (int) $firConvertedData->amount_lost_fir_converted + (int) $pendingConversionData->amount_lost_pending_conversion;
        $totalComplaintsPOH = (int) $firConvertedData->poh_fir_converted + (int) $pendingConversionData->poh_pending_conversion;

        $xAxis = $totalComplaintsAmountLost + $totalComplaintsPOH;

        // Prepare the data for the graph
        $graphData = [
            'categories' => ['Amount Lost > 1 Lakh', 'POH > 25000'],
            'total_complaints' => [(int) $totalComplaintsAmountLost, (int) $totalComplaintsPOH],
            'fir_converted' => [(int) $firConvertedData->amount_lost_fir_converted, (int) $firConvertedData->poh_fir_converted],
            'pending_conversion' => [(int) $pendingConversionData->amount_lost_pending_conversion ?? 0, (int) $pendingConversionData->poh_pending_conversion ?? 0],
            'urls' => [
                'total_complaints' => [
                    route('fir-conversions.list.type', ['listType' => 'total-complaints', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'total-complaints', 'basedOn' => 'poh-more-than-25000']),
                ],
                'fir_converted' => [
                    route('fir-conversions.list.type', ['listType' => 'fir-converted', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'fir-converted', 'basedOn' => 'poh-more-than-25000']),
                ],
                'pending_conversion' => [
                    route('fir-conversions.list.type', ['listType' => 'pending-conversions', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'pending-conversions', 'basedOn' => 'poh-more-than-25000']),
                ]
            ],
            'xAxis' => $xAxis
        ];

        return $graphData;
    }

    public function _graph3Data()
    {
        $firConversionData = $this->totalPoh
            ->rightJoin('Sample_Additional_Information', 'Sample_Total_POH.NCRP Ack No', '=', 'Sample_Additional_Information.Acknowledgement_No')
            ->select(
                'Sample_Additional_Information.Acknowledgement_No',
                'Sample_Total_POH.Amount Lost as amount_lost',
                'Sample_Total_POH.Amount POH as amount_poh',
                'Sample_Additional_Information.status'
            )
            ->get();

        // Initialize arrays to hold counts
        $amountLostMoreThanLakh = [
            'total_complaints' => 0,
            'fir_converted' => 0,
            'pending_conversion' => 0
        ];

        $pohMoreThan25000 = [
            'total_complaints' => 0,
            'fir_converted' => 0,
            'pending_conversion' => 0
        ];

        foreach ($firConversionData as $data) {
            // Total Complaints Count
            if ($data->amount_lost > 100000) {
                $amountLostMoreThanLakh['total_complaints'] = $amountLostMoreThanLakh['total_complaints'] + 1;
            }

            if ($data->amount_poh > 25000) {
                $pohMoreThan25000['total_complaints'] = $pohMoreThan25000['total_complaints'] + 1;
            }

            // FIR Converted Count
            if (in_array($data->status, ['Registered', 'FIR Registered'])) {
                if ($data->amount_lost > 100000) {
                    $amountLostMoreThanLakh['fir_converted'] = $amountLostMoreThanLakh['fir_converted'] + 1;
                }

                if ($data->amount_poh > 25000) {
                    $pohMoreThan25000['fir_converted'] = $pohMoreThan25000['fir_converted'] + 1;
                }
            }

            // Pending Conversion Count
            if (!in_array($data->status, ['Registered', 'FIR Registered', 'Closed'])) {
                if ($data->amount_lost > 100000) {
                    $amountLostMoreThanLakh['pending_conversion'] = $amountLostMoreThanLakh['pending_conversion'] + 1;
                }

                if ($data->amount_poh > 25000) {
                    $pohMoreThan25000['pending_conversion'] = $pohMoreThan25000['pending_conversion'] + 1;
                }
            }
        }

        // Prepare data for chart
        $chartData = [
            'categories' => ['Amount Lost > 1 Lakh', 'POH > 25000'],
            'total_complaints' => [
                $amountLostMoreThanLakh['total_complaints'],
                $pohMoreThan25000['total_complaints']
            ],
            'fir_converted' => [
                $amountLostMoreThanLakh['fir_converted'],
                $pohMoreThan25000['fir_converted']
            ],
            'pending_conversion' => [
                $amountLostMoreThanLakh['pending_conversion'],
                $pohMoreThan25000['pending_conversion']
            ],
            'urls' => [
                'total_complaints' => [
                    route('fir-conversions.list.type', ['listType' => 'total-complaints', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'total-complaints', 'basedOn' => 'poh-more-than-25000']),
                ],
                'fir_converted' => [
                    route('fir-conversions.list.type', ['listType' => 'fir-converted', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'fir-converted', 'basedOn' => 'poh-more-than-25000']),
                ],
                'pending_conversion' => [
                    route('fir-conversions.list.type', ['listType' => 'pending-conversions', 'basedOn' => 'amount-lost-more-than-one-lakh']),
                    route('fir-conversions.list.type', ['listType' => 'pending-conversions', 'basedOn' => 'poh-more-than-25000']),
                ]
            ]
        ];


        dd($chartData);

        return $chartData;
    }

    protected function graph4Data()
    {
        $cyberCrimeInfo = DB::table('Cyber_Crime_Info')
            ->select(
                DB::raw("
                    SUM(CASE WHEN FIR_STATUS IS NULL OR FIR_STATUS = '' THEN 1 ELSE 0 END) as pending_arrest,
                    SUM(CASE WHEN FIR_STATUS IN ('UI Cases', 'Under Investigation') THEN 1 ELSE 0 END) as pending_chargesheet,
                    SUM(CASE WHEN FIR_STATUS IN ('Chargesheet Created', 'Chargesheeted') THEN 1 ELSE 0 END) as charged,
                    SUM(CASE WHEN FIR_STATUS IN ('Under Trial', 'Pending Trial', 'PT Cases') THEN 1 ELSE 0 END) as under_trial,
                    SUM(CASE WHEN FIR_STATUS IN ('Disposal', 'Disposed Of', 'Quashed') THEN 1 ELSE 0 END) as closed
                ")
            )->first();

        // Create an array to store the counts
        $cyberCrimeInfoCountsArray = [
            $cyberCrimeInfo->pending_arrest,
            $cyberCrimeInfo->pending_chargesheet,
            $cyberCrimeInfo->charged,
            $cyberCrimeInfo->under_trial,
            $cyberCrimeInfo->closed
        ];

        // Get the maximum value
        $cyberCrimeInfoMaxCount = max($cyberCrimeInfoCountsArray);

        return ['cyberCrimeInfo' => $cyberCrimeInfo, 'cyberCrimeInfoMaxCount' => $cyberCrimeInfoMaxCount];
    }
}
