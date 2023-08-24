<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Address;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Requests\NewCityRequest;
use App\Http\Requests\EditCityRequest;
use App\Http\Requests\NewCountryRequest;
use App\Http\Requests\EditCountryRequest;
use App\Http\Requests\NewDistrictRequest;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\EditDistrictRequest;

class AddressController extends Controller
{

    public function userAddress()
    {
        $countries = Country::get(['country_name','id']);
        
        return view('address.user_address',compact('countries'));
    }

    // Ajax City
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where('country_id',$request->country_id)->get(['city_name','id']);
        $data = Address::checkAjax($data, 'cities');

        return response()->json($data);
    }
 
    // Ajax District
    public function fetchDistrict(Request $request)
    {
        $data['districts'] = District::where('city_id',$request->city_id)->get(['district_name','id']);
        $data = Address::checkAjax($data, 'districts');

        return response()->json($data);
    }

    public function saveAddress(UserAddressRequest $request, $user_id)
    {
        Address::create($request->validated()+[
            'user_id' => $user_id
        ]);

        return redirect(route('allAddress'));
    }

    public function newCountry()
    {
        return view('address.new_country');
    }

    public function newCity()
    {
        $countries = Country::all();

        return view('address.new_city',compact('countries'));
    }

    public function newDistrict()
    {
        $countries = Country::all();
        $cities = City::all();

        return view('address.new_district',compact('countries','cities'));
    }

    public function saveNewCountry(NewCountryRequest $request)
    {
        Country::create($request->validated());
        return redirect(route('allCountry'));
    }

    public function saveNewCity(NewCityRequest $request)
    {
        City::create($request->validated());

        return redirect(route('allCity'));
    }

    public function saveNewDistrict(NewDistrictRequest $request)
    {
        District::create($request->validated());

        return redirect(route('allDistrict'));
    }

    public function allAddress()
    {
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        $user_addresses = Address::all();

        return view('address.all_address',compact('countries','cities','districts','user_addresses'));
    }
    public function allDistrict()
    {
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();

        return view('address.all_district',compact('countries','cities','districts'));
    }

    public function allCity()
    {
        $countries = Country::all();
        $cities = City::all();

        return view('address.all_city',compact('countries','cities'));
    }

    public function allCountry()
    {
        $countries = Country::all();

        return view('address.all_country',compact('countries'));
    }

    public function editCountry($country_id) 
    {
        $country = Country::find($country_id);

        return view('address.edit_country',compact('country')); 
    }
    
    public function saveEditCountry(Country $country, EditCountryRequest $request) 
    {
        $country->update($request->validated());

        return redirect(route('allCountry'));
    }

    public function deleteCountry(Country $country)
    {    
        $country->delete();

        return back(); 
    }

    public function editCity($city_id) 
    {
        $city = City::find($city_id);

        return view('address.edit_city',compact('city')); 
    }

    public function saveEditCity(City $city, EditCityRequest $request) 
    {
        $city->update($request->validated());

        return redirect(route('allCity'));
    }

    public function deleteCity(City $city)
    {    
        $city->delete();

        return back(); 
    }

    public function editDistrict($district_id) 
    {
        $district = District::find($district_id);

        return view('address.edit_district',compact('district')); 
    }

    public function saveEditDistrict(district $district, EditDistrictRequest $request) 
    {
        $district->update($request->validated());

        return redirect(route('allDistrict'));
    }
    
    public function deleteDistrict(District $district)
    {    
        $district->delete();

        return back(); 
    }
}
