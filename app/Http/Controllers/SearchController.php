<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CyberAccuPersonalData;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $cyberAccuPersonalData;

    public function __construct(
        CyberAccuPersonalData $_cyberAccuPersonalData
    ) {
        $this->cyberAccuPersonalData = $_cyberAccuPersonalData;
    }

    public function index(Request $request)
    {
        $habitualOffenders  = DB::table('FIR_Conversions')
            ->where('FIR_Conversions.State', ('Telangana'))
            ->leftJoin('Cyber_Accu_Personal_Data', 'FIR_Conversions.Acknowledgement_No', 'Cyber_Accu_Personal_Data.ACCUSED_NO');
        // ->leftJoin('Sample_layer_Accounts', 'Sample_layer_Accounts.Acknowledgement No ', '=', 'FIR_Conversions.Acknowledgement_No');
        if (isset(request()->search) && !empty(request()->search)) {
            $habitualOffenders->where('FIR_Conversions.Acknowledgement_No', 'LIKE', '%' . request()->search . '%')
                ->orWhere('FIR_Conversions.Category', 'LIKE', '%' . request()->search . '%')
                ->orWhere('FIR_Conversions.Police_Station', 'LIKE', '%' . request()->search . '%');
        }
        $searchData = $habitualOffenders->paginate(50);
        return view('pages.search.index', compact('searchData'));
    }
}
