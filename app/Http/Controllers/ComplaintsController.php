<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function financial(Request $request){
        return view('pages.complaints.financial');
    }
    public function nonFinancial(Request $request){
        return view('pages.complaints.non-financial');
    }
}
