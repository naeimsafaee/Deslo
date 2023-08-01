<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{



    public function __invoke(Request $request){
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.profile', compact('client'));
    }


    public function showRegister(){
        return view('auth.layouts.set_name');
    }

    public function register(Request $request){
        if ($request->is_hoghoghi == 'on') {
            if (!isset($request->company_name))
                return redirect()->back()->with('error', 'لطفا نام شرکت خود را وارد کنید')->withInput();
            if (!isset($request->eghtesadi_code))
                return redirect()->back()->with('error', 'لطفا کد اقتصادی خود را وارد کنید')->withInput();
            if (!isset($request->shenase_melli))
                return redirect()->back()->with('error', 'لطفا شناسه ملی خود را وارد کنید')->withInput();
            if (!isset($request->sabt_number))
                return redirect()->back()->with('error', 'لطفا شماره ثبت شرکت خود را وارد کنید')->withInput();
            if (!isset($request->landline_phone))
                return redirect()->back()->with('error', 'لطفا شماره ثابت خود را وارد کنید')->withInput();
            if (!isset($request->address))
                return redirect()->back()->with('error', 'لطفا آدرس دفتر خود را وارد کنید')->withInput();

            $client = Auth::guard('clients')->user();
            $client->is_haghighi = false;
            $client->company_name = $request->company_name;
            $client->eghtesadi_code = $request->eghtesadi_code;
            $client->shenase_melli = $request->shenase_melli;
            $client->sabt_number = $request->sabt_number;
            $client->landline_phone = $request->landline_phone;
            $client->address = $request->address;
            $client->is_registered = true;
            $client->save();
        }else {
            if (!isset($request->full_name))
                return redirect()->back()->with('error', 'لطفا نام خود را وارد کنید')->withInput();
            if (!isset($request->birthdate))
                return redirect()->back()->with('error', 'لطفا تاریخ تولد خود را وارد کنید')->withInput();
            if (!isset($request->melli_code))
                return redirect()->back()->with('error', 'لطفا کد ملی خود را وارد کنید')->withInput();
            if (!isset($request->home_phone))
                return redirect()->back()->with('error', 'لطفا شماره منزل خود را وارد کنید')->withInput();
            if (!isset($request->email))
                return redirect()->back()->with('error', 'لطفا ایمیل خود را وارد کنید')->withInput();

            $client = Auth::guard('clients')->user();
            $client->is_haghighi = true;
            $client->full_name = $request->full_name;
            $client->birthdate = fa_number($request->birthdate, true);
            $client->melli_code = $request->melli_code;
            if($request->is_foreign == 'on')
                $client->is_foreign = true;
            $client->landline_phone = $request->home_phone;
            $client->email = $request->email;
            $client->is_registered = true;
            $client->save();
        }
        return redirect()->intended();
    }

    public function logout(Request $request){
        auth()->guard('clients')->logout();
        Session()->forget('phone');
        $request->session()->regenerate();
        return redirect()->route('home');
    }

}
