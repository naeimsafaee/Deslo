<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ClientProfile;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller{

    public function __invoke(){
        return view('auth.layouts.verify');
    }

    protected function verify(Request $request){

        $code = implode('', $request->code);
        if (!$code || strlen($code) != 4) {
            return redirect()->back()->with('error', 'کد تایید وارد شده معتبر نیست');
        }

        if (!Session('phone')) {
            return redirect()->back()->with('error', 'شماره موبایل یافت نشد');
        }

        $client = Client::query()->where('phone', Session('phone'))->first();
        if ($client == null) {
            return redirect()->back()->with('error', 'کاربر یافت نشد');
        }

        if ($client->verify_code != $code) {
            return redirect()->back()->with('error', 'کد وارد شده اشتباه است');
        }

        Auth::guard('clients')->loginUsingId($client->id, true);
        $request->session()->regenerate();
        return redirect()->route('profile');
    }

}
