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
            ->leftJoin('Cyber_Accu_Personal_Data', 'FIR_Conversions.Acknowledgement_No', 'Cyber_Accu_Personal_Data.ACCUSED_NO')
            ->leftJoin('Cyber_Accu_Phone', 'Cyber_Accu_Phone.ACCUSED_NO', '=', 'FIR_Conversions.Acknowledgement_No');
        // ->leftJoin('Sample_layer_Accounts', 'Sample_layer_Accounts.Acknowledgement No ', '=', 'FIR_Conversions.Acknowledgement_No');

        if (isset(request()->option) && !empty(request()->option)) {

            if (request()->option == 'link') {
                $habitualOffenders->where(function ($query) {
                    $query->where('FIR_Conversions.Acknowledgement_No', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('FIR_Conversions.Category', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('FIR_Conversions.Police_Station', 'LIKE', '%' . request()->search . '%');
                })
                    ->orWhere('Cyber_Accu_Personal_Data.ACCU_BANK_ACCOUNT', request()->mobile_no)
                    ->orWhere('Cyber_Accu_Phone.ACCU_PHONE', request()->mobile_no);
            } else {
                $habitualOffenders->where(function ($query) {
                    $query->where('FIR_Conversions.Acknowledgement_No', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('FIR_Conversions.Category', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('FIR_Conversions.Police_Station', 'LIKE', '%' . request()->search . '%');
                })->where('Cyber_Accu_Personal_Data.ACCU_BANK_ACCOUNT', request()->mobile_no)
                    ->where('Cyber_Accu_Phone.ACCU_PHONE', request()->mobile_no);
            }
        }

        $searchData = $habitualOffenders->paginate(50);
        return view('pages.search.index', compact('searchData'));
    }
}
