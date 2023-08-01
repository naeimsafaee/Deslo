<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Notifications\SendSMS;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


class RegisterController extends Controller{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
    }

    public function showRegistrationForm(){

        auth()->guard('clients')->logout();
        session(['url.intended' => url()->previous()]);

        return view('auth.layouts.login');
    }



    protected function create(array $data){

        $code = rand(1000, 9999);

        $client = Client::query()->updateOrCreate([
            'phone' => $data['phone'],
        ], [
            'phone' => $data['phone'],
            "verify_code" => $code,
            "phone_verified" => 0,
        ]);

        $client->notify(new SendSMS($client->phone, $code));

        return $client;
    }

    public function register(Request $request){

//        $this->validator($request->all())->validate();

        $client = $this->create($request->all());

        auth()->guard('clients')->login($client);

        $this->registered($request, $client);

        return redirect()->route('verify');
    }

}
