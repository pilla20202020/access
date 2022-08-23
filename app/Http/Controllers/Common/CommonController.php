<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getStatesByCountryId(Request $request)
    {
        $states= getStatesByCountryId($request->country_id);
        return response()->json(['states' =>$states],200);
    }

    public function getCollegesByStateId(Request $request)
    {

        $colleges= getCollegesByStateId($request->state_id);
        return response()->json(['colleges' =>$colleges],200);
    }

    public function getDistrictsByProvinceId(Request $request)
    {
        $districts= getDistrictsByProvinceId($request->state_id);
        return response()->json(['districts' =>$districts],200);
    }
}

