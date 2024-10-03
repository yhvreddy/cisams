<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PTWarrants;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;


class PTWarrantyController extends Controller
{

    protected PTWarrants $ptWarrants;

    public function __construct(
        PTWarrants $_ptWarrants
    ) {
        $this->ptWarrants = $_ptWarrants;
    }

    public function firLinks(Request $request)
    {
        $districtFirCounts = $this->ptWarrants
            ->select('UNIT as district', DB::raw('COUNT(*) as fir_count'))
            ->where('SOURCE', 'FIR')
            ->where('STATE', 'TELANGANA')
            ->groupBy('UNIT')
            ->orderBy('fir_count', 'DESC')
            ->get();

        // Convert the result to JSON format for the graph
        $districtLabels = $districtFirCounts->pluck('district')->toArray(); // ['Hyderabad', etc.]
        $districtData = $districtFirCounts->pluck('fir_count')->toArray();  // [15, etc.]
        $districtLinks = $districtFirCounts->pluck('district')->map(function ($district) {
            return route('pt_warranty.district.data', ['district' => strtolower(urlencode($district)), 'type' => 'fir']); // Assuming you have a route for district details
        })->toArray(); // ['url1', 'url2', etc.]

        // Generate dynamic colors for each district
        $colors = array_map(function () {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random hex color
        }, $districtLabels);

        return view('pages.pt-warranty.fir-links', compact('districtLabels', 'districtData', 'districtLinks', 'colors'));
    }

    public function ncrpLinks(Request $request)
    {
        $districtFirCounts = $this->ptWarrants
            ->select('UNIT as district', DB::raw('COUNT(*) as fir_count'))
            ->whereIn('SOURCE', ['FIR', 'CFCFRMS'])
            ->where('STATE', 'TELANGANA')
            ->groupBy('UNIT')
            ->orderBy('fir_count', 'DESC')
            ->get();

        // Convert the result to JSON format for the graph
        $districtLabels = $districtFirCounts->pluck('district')->toArray(); // ['Hyderabad', etc.]
        $districtData = $districtFirCounts->pluck('fir_count')->toArray();  // [15, etc.]
        $districtLinks = $districtFirCounts->pluck('district')->map(function ($district) {
            return route('pt_warranty.district.data', ['district' => strtolower(urlencode($district)), 'type' => 'ncrp']); // Assuming you have a route for district details
        })->toArray(); // ['url1', 'url2', etc.]

        // Generate dynamic colors for each district
        $colors = array_map(function () {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random hex color
        }, $districtLabels);

        return view('pages.pt-warranty.ncrp-links', compact('districtLabels', 'districtData', 'districtLinks', 'colors'));
    }

    public function executed(Request $request)
    {
        $districtFirCounts = $this->ptWarrants
            ->select('UNIT as district', DB::raw('COUNT(*) as fir_count'))
            ->where('PT_EXECUTED', 'Yes')
            ->where('STATE', 'TELANGANA')
            ->groupBy('UNIT')
            ->orderBy('fir_count', 'DESC')
            ->get();

        // Convert the result to JSON format for the graph
        $districtLabels = $districtFirCounts->pluck('district')->toArray(); // ['Hyderabad', etc.]
        $districtData = $districtFirCounts->pluck('fir_count')->toArray();  // [15, etc.]
        $districtLinks = $districtFirCounts->pluck('district')->map(function ($district) {
            return route('pt_warranty.district.data', ['district' => strtolower(urlencode($district)), 'type' => 'executed']); // Assuming you have a route for district details
        })->toArray(); // ['url1', 'url2', etc.]

        // Generate dynamic colors for each district
        $colors = array_map(function () {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random hex color
        }, $districtLabels);

        return view('pages.pt-warranty.ncrp-links', compact('districtLabels', 'districtData', 'districtLinks', 'colors'));
    }

    public function pending(Request $request)
    {
        $districtFirCounts = $this->ptWarrants
            ->select('UNIT as district', DB::raw('COUNT(*) as fir_count'))
            ->where('PT_EXECUTED', 'No')
            ->where('STATE', 'TELANGANA')
            ->groupBy('UNIT')
            ->orderBy('fir_count', 'DESC')
            ->get();

        // Convert the result to JSON format for the graph
        $districtLabels = $districtFirCounts->pluck('district')->toArray(); // ['Hyderabad', etc.]
        $districtData = $districtFirCounts->pluck('fir_count')->toArray();  // [15, etc.]
        $districtLinks = $districtFirCounts->pluck('district')->map(function ($district) {
            return route('pt_warranty.district.data', ['district' => strtolower(urlencode($district)), 'type' => 'pending']); // Assuming you have a route for district details
        })->toArray(); // ['url1', 'url2', etc.]

        // Generate dynamic colors for each district
        $colors = array_map(function () {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random hex color
        }, $districtLabels);

        return view('pages.pt-warranty.pending-links', compact('districtLabels', 'districtData', 'districtLinks', 'colors'));
    }

    public function districtData($district, $type)
    {
        $district = ucwords(urldecode($district));
        // Fetch the listing data for the selected district
        $listingData = DB::table('Sample_PT_Warrants')
            ->select('ACCUSED_NAME', 'FIR_NO', 'PT_EXECUTED', 'ARRESTED_CRIME')
            ->where('UNIT', urldecode($district))
            ->where('STATE', 'TELANGANA');

        if ($type == 'fir') {
            $typeName = 'FIR Links';
            $listingData->where('SOURCE', 'FIR');
        }
        if ($type == 'ncrp') {
            $typeName = 'NCRP Links';
            $listingData->whereIn('SOURCE', ['FIR', 'CFCFRMS']);
        }
        if ($type == 'executed') {
            $typeName = 'PT Warranty Executed';
            $listingData->where('PT_EXECUTED', 'Yes');
        }
        if ($type == 'pending') {
            $typeName = 'PT Warranty Pending';
            $listingData->where('PT_EXECUTED', 'No');
        }

        $listingData = $listingData->get();

        return view('pages.pt-warranty.districts_data', compact('listingData', 'district', 'typeName', 'type'));
    }
}
