<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __invoke(Request $request)
    {
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);

        $transactions = Transaction::query()->where('client_id' , '=' , $client_id)->get();

        return view('client.profile.orders' , compact('client' , 'transactions'));
    }
}
