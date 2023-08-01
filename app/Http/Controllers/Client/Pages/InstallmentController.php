<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller{

    public function __invoke(Request $request){

        $installments = Installment::all();
        return view('client.pages.installment', compact('installments'));
    }
}
