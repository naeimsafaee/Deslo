<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Client;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function __invoke(Request $request)
    {
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.address', compact('client'));
    }

    public function delete(Request $request, Address $address) {
        $address->delete();
        return redirect()->back();
    }

    public function edit(Request $request, Address $address) {

        $provinces = Province::all();
        $cities = City::all();
        return view('client.profile.address_edit', compact('address' , 'provinces' , 'cities'));
    }

    public function edit_submit(Request $request) {

        Validator::make($request->all(), [
            'full_name' => ['required'],
            'postal_code' => ['required'],
            'city_id' => ['required', 'not_in:0'],
            'town_id' => ['required', 'not_in:0'],
            'address' => ['required'],
        ], [
            'full_name.required' => "نام و نام خانوادگی خود را وارد کنید",
            'postal_code.required' => "کد پستی خود را وارد کنید",
            'city_id.required' => "شهر خود را انتخاب کنید",
            'city_id.not_in' => "شهر خود را انتخاب کنید",
            'town_id.required' => "استان خود را انتخاب کنید",
            'town_id.not_in' => "استان خود را انتخاب کنید",
            'address.required' => "آدرس خود را وارد کنید",
        ])->validate();

        $address = Address::query()->findOrFail($request->address_id);
        $address->full_name = $request->full_name;
        $address->postal_code = $request->postal_code;
        $address->city_id = $request->city_id;
        $address->town_id = $request->town_id;
        $address->address = $request->address;
        $address->save();
       return redirect()->route('profile_address');
    }
}
