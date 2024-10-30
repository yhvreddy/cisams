<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CyberAccuPersonalData;
use Illuminate\Support\Facades\DB;

class HabitualOffendersController extends Controller
{

    protected $cyberAccuPersonalData;

    public function __construct(
        CyberAccuPersonalData $_cyberAccuPersonalData
    ) {
        $this->cyberAccuPersonalData = $_cyberAccuPersonalData;
    }


    public function index()
    {
        $districtData = $this->cyberAccuPersonalData
            ->select('PERSON_DISTRICT', DB::raw('count(*) as total'))
            ->where('PERSON_STATE', 'Telangana')
            ->whereNotNull('PERSON_DISTRICT')
            ->where('PERSON_DISTRICT', '!=', '0')  // Compare 'PERSON_DISTRICT' with string '0'
            ->groupBy('PERSON_DISTRICT')
            ->get();
        $labels = $districtData->pluck('PERSON_DISTRICT');
        $data = $districtData->pluck('total');

        // Generate dynamic URLs for each district
        $urls = $districtData->map(function ($district) {
            return route('habitual.list', [
                'state' => 'Telangana',
                'district' => $district->PERSON_DISTRICT
            ]);
        });

        // Generate dynamic colors for each district
        $backgroundColors = $districtData->map(function () {
            return
                '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);;
        });


        return view('pages.habitual-offenders.index', compact('labels', 'data', 'districtData', 'urls', 'backgroundColors'));
    }


    public function districtWiseList($state, $district)
    {
        $habitualOffenders  = $this->cyberAccuPersonalData
            ->where('PERSON_STATE', ($state ?? 'Telangana'))
            ->where('PERSON_DISTRICT', $district);
        if (isset(request()->search) && !empty(request()->search)) {
            $habitualOffenders->where('ACCUSED_NO', 'LIKE', '%' . request()->search . '%')
                ->orWhere('FULNAME', 'LIKE', '%' . request()->search . '%')
                ->orWhere('fir_reg_num', 'LIKE', '%' . request()->search . '%');
        }

        $habitualOffenders = $habitualOffenders->paginate(50);
        return view('pages.habitual-offenders.list', compact('state', 'district', 'habitualOffenders'));
    }
}
