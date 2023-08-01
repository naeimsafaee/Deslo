<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\Pickup;
use App\Models\Province;
use Illuminate\Http\Request;

class PickupsController extends Controller
{
    public function __invoke(Request $request)
    {
        // $client_id = auth()->guard('clients')->user()->id;
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.pickup' , compact('client'));
    }

    public function new()
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('client.profile.new_pickup' , compact('provinces', 'cities'));
    }

    public function new_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'iran_mobile'],
            'model' => ['required'],
            'piano_type' => ['required'],
            'type' => ['required'],
            'address' => ['required'],
            'floors' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
        ], [
            'name.required' => "نام الزامی است.",
            'phone.required' => "شماره همراه الزامی است.",
            'model.required' => "متن پیام الزامی است.",
            'piano_type.required' => "متن نوع پیانو الزامی است.",
            'type.required' => "متن پیام الزامی است.",
            'address.required' => "متن پیام الزامی است.",
            'floors.required' => "متن پیام الزامی است.",
            'province.required' => "استان خود را انتخاب کنید",
            'city.required' => "شهر خود را انتخاب کنید",
        ]);
        Pickup::query()->create([
            'full_name' => $request->name,
            'phone' => $request->phone,
            'model' => $request->model,
            'piano_type' => $request->piano_type,
            'type' => $request->type,
            'address' => $request->address,
            'town_id' => $request->province,
            'city_id' => $request->city,
            'client_id' => auth()->guard('clients')->user()->id,
            'floors' => $request->floors,
            'status' => config('Constants.pickup_status.pending')
        ]);
        return redirect()->back()->with('success', 'درخواست شما برای باربری با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت');
    }

}
