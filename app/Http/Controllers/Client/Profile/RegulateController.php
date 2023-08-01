<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\Province;
use App\Models\Regulate;
use Illuminate\Http\Request;

class RegulateController extends Controller
{


    public function __invoke(Request $request)
    {
       // $client_id = auth()->guard('clients')->user()->id;
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.regulate' , compact('client'));
    }
    public function new()
    {
        $provinces = Province::all();
        $cities = City::all();

        return view('client.profile.new_regulate' , compact('provinces', 'cities'));
    }

    public function new_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'iran_mobile'],
            'model' => ['required'],
            'date' => ['required'],
            'serial' => ['required'],
            'type' => ['required'],
            'address' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
        ], [
            'name.required' => "نام الزامی است.",
            'phone.required' => "شماره همراه الزامی است.",
            'model.required' => "متن پیام الزامی است.",
            'date.required' => "متن پیام الزامی است.",
            'serial.required' => "متن پیام الزامی است.",
            'type.required' => "متن پیام الزامی است.",
            'address.required' => "متن پیام الزامی است.",
            'province.required' => "استان خود را انتخاب کنید",
            'city.required' => "شهر خود را انتخاب کنید",
        ]);
        Regulate::query()->create([
            'full_name' => $request->name,
            'phone' => $request->phone,
            'model' => $request->model,
            'date' => $request->date,
            'serial' => $request->serial,
            'type' => $request->type,
            'address' => $request->address,
            'town_id' => $request->province,
            'city_id' => $request->city,
            'client_id' => auth()->guard('clients')->user()->id,
        ]);
        return redirect()->back()->with('success', 'درخواست شما برای کوک و رگلاژ با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت');
    }

}
