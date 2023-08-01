<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ClientProfile;
use App\Models\Client;
use App\Notifications\SendSMS;
use Illuminate\Http\Request;


class LoginController extends Controller{

    public function __invoke(){

        if (Session('phone')) {
            $phone = Session('phone');

            $code = rand(1000, 9999);

            $client = Client::query()->updateOrCreate([
                'phone' => $phone,
            ], [
                'phone' => $phone,
                "verify_code" => $code
            ]);

            $client->notify(new SendSMS($client->phone, $code));
            return redirect()->route('verify');
        }

        return view('auth.layouts.login');
    }

    public function login(Request $request) {
        if (!isset($request->phone)) {
            return redirect()->back()->with('error', 'شماره تلفن خود را وارد کنید');
        }
        if (strlen($request->phone) != 11) {
            return redirect()->back()->with('error', 'شماره تلفن وارد شده معتبر نیست');
        }
        $code = rand(1000, 9999);

        $client = Client::query()->updateOrCreate([
            'phone' => $request->phone,
        ], [
            'phone' => $request->phone,
            "verify_code" => $code
        ]);

        session(['phone' => $request->phone]);
        $client->notify(new SendSMS($client->phone, $code));

        return redirect()->route('verify');
    }
}
