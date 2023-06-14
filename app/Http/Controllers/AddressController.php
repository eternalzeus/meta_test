<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function country(){
        $counteries = Country::get(['country_name','id']);
        return view('address.address',compact('counteries'));
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where('country_id',$request->country_id)->get(['city_name','id']);
        return response()->json($data);
    }
 
    public function fetchDistrict(Request $request)
    {
        $data['districts'] = District::where('city_id',$request->city_id)->get(['district_name','id']);
        return response()->json($data);
    }
}
