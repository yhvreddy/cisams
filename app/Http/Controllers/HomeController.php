<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Traits\HandlesCustomExceptions;
use App\Enums\AccountStatus;
use App\Models\PTWarrants;
use  App\Models\AdditionalInformation;
use Carbon\Carbon;

class HomeController extends Controller
{
    use HandlesCustomExceptions;

    protected PTWarrants $ptWarrants;
    protected AdditionalInformation $additionalInformation;

    public function __construct(
        PTWarrants $_ptWarrants,
        AdditionalInformation $_additionalInformation
    ) {
        $this->ptWarrants = $_ptWarrants;
        $this->additionalInformation = $_additionalInformation;
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

        //graph one
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

        //graph 2
        $categoryCounts = $this->additionalInformation
            ->select('Category')
            ->groupBy('Category')
            ->get();
        $categoryNames = [];
        foreach ($categoryCounts as $categoryCount) {
            $categoryNames[] = $categoryCount->Category; // Add the category name to the array
        }
        $categoryNamesJson = json_encode($categoryNames);


        // Fetch data for the last three months, grouped by category
        $categoryData = $this->additionalInformation
            ->selectRaw('Category, MONTH(Incident_Date) as incident_date, COUNT(*) as category_count')
            ->where('Incident_Date', '>=', Carbon::now()->subMonths(3)->startOfMonth())
            ->groupBy('Category', 'incident_date')
            ->orderBy('incident_date', 'asc')
            ->get();
        dd($categoryData);
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

        // Prepare category names and populate monthly data
        $categoryNames = [];
        foreach ($categoryData as $data) {
            if (!in_array($data->Category, $categoryNames)) {
                $categoryNames[] = $data->Category;
            }

            // Assign counts to the correct month
            $monthName = Carbon::createFromDate(null, $data->month, 1)->format('F');
            if ($monthName == $lastThreeMonths[0]) {
                $monthlyData[$lastThreeMonths[0]][] = $data->category_count;
            } elseif ($monthName == $lastThreeMonths[1]) {
                $monthlyData[$lastThreeMonths[1]][] = $data->category_count;
            } elseif ($monthName == $lastThreeMonths[2]) {
                $monthlyData[$lastThreeMonths[2]][] = $data->category_count;
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
        dd($monthDataJson, $categoryData);
        return view('pages.home', compact('ptWarrantCountsJSON', 'graphOneCountJson', 'nonFinancialChartJson', 'financialChartJson', 'categoryNamesJson'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
