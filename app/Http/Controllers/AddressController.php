<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Address;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function userAddress(){
        $counteries = Country::get(['country_name','id']);
        return view('address.user_address',compact('counteries'));
    }

    private function _commonCheck($data, $value)
    {
        if($data[$value] -> isEmpty()){
            $data['status'] = 400;
        }
        else $data['status'] = 200;
        return $data;
    }
    //ten ham chung
    //noi viet
    //tham so truyen vao
    // Ajax City
    public function fetchCity(Request $request){
        $data['cities'] = City::where('country_id',$request->country_id)->get(['city_name','id']);

        // if($data['cities'] -> isEmpty()){
        //     $data['status'] = 400;
        // }
        // else $data['status'] = 200;
        // $data = $this->_commonCheck($data, 'cities');
        $data = City::commonCheck($data, 'cities', 'status');

        return response()->json($data);
    }
 
    // Ajax District
    public function fetchDistrict(Request $request){
        $data['districts'] = District::where('city_id',$request->city_id)->get(['district_name','id']);
        // if($data['districts'] -> isEmpty()){
        //     $data['status'] = 400;
        // }
        // else $data['status'] = 200;
        $data = City::commonCheck($data, 'districts', 'status');
        return response()->json($data);
    }

    public function saveAddress(Request $request, $user_id){
        $rules = [
            'country_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'user_address' => 'required',
        ];
        $message = [
            'country_id' => 'Country is required',
            'city_id' => 'City is required',
            'district_id' => 'District is required',
            'user_address' => 'Address is required',
        ];
        $address = $request->validate($rules, $message);
        $address['country_id'] = $request->country_id; 
        $address['city_id'] = $request->city_id;
        $address['district_id'] = $request->district_id;
        $address['user_id'] = $user_id;
        Address::create($address);
        return back();
    }

    public function newCountry(){
        return view('address.new_country');
    }

    public function newCity($country_id){
        $country = Country::find($country_id);
        return view('address.new_city',compact('country'));
    }

    public function newDistrict($city_id){
        $city = City::find($city_id);
        return view('address.new_district',compact('city'));
    }

    public function saveNewCountry(Request $request){
        $rules = [
            'new_country' => 'required',
            'new_city' => 'required',
            'new_district' => 'required'
        ];
        $message = [
            'new_country'=>'Country is required',
            'new_city'=>'City is required',
            'new_district'=>'District is required',
        ];
        $address = $request->validate($rules, $message);
        $new_country['country_name'] = $request->new_country;
        Country::create($new_country);
        $new_city['city_name'] = $request->new_city;
        $new_city['country_id'] = Country::find(Country::max('id'))->id;
        City::create($new_city);
        $new_district['district_name'] = $request->new_district;
        $new_district['city_id'] = City::find(City::max('id'))->id;
        District::create($new_district);
        return redirect(route('allAddress'));
    }

    public function saveNewCity(Request $request, $country_id){
        $rules = [
            'new_city' => 'required',
            'new_district' => 'required'
        ];
        $message = [
            'new_city'=>'City is required',
            'new_district'=>'District is required',
        ];
        $address = $request->validate($rules, $message);
        $new_city['city_name'] = $request->new_city;
        $new_city['country_id'] = $country_id;
        City::create($new_city);
        $new_district['district_name'] = $request->new_district;
        $new_district['city_id'] = City::find(City::max('id'))->id;
        District::create($new_district);
        return redirect(route('allAddress'));
    }

    public function saveNewDistrict(Request $request, $city_id){
        $rules = [
            'new_district' => 'required'
        ];
        $message = [
            'new_district'=>'District is required',
        ];
        $address = $request->validate($rules, $message);
        $new_district['district_name'] = $request->new_district;
        $new_district['city_id'] = $city_id;
        District::create($new_district);
        return redirect(route('allAddress'));
    }
    public function allAddress(){
        $countries = Country::all(); // get() ~ SELECT, where() ~ WHERE in querry
        $cities = City::all();
        $districts = District::all();
        return view('address.all_address',compact('countries','cities','districts'));
    }

}
