<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\ClientToInstallments;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\TransationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class IntallmentsController extends Controller {

    public function __invoke(Request $request) {

        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);

        return view('client.profile.Installments', compact('client'));
    }

    public function pay($id) {

        $client_id = auth()->guard('clients')->user()->id;

        $installment = ClientToInstallments::query()->findOrFail($id);

        $price = $installment->price;

        $invoice = new Invoice;
        $invoice->amount((int)$price);

        return Payment::callbackUrl(route('callback_installment'))->purchase($invoice,
            function($driver, $transactionId) use ($price, $client_id, $installment) {

                $factor_number = $transactionId;

                $transaction = new Transaction();
                $transaction->amount = $price;
                $transaction->client_id = $client_id;
                $transaction->transaction_date = Carbon::now();
                $transaction->status = config('Constants.TransactionStatus.pending');
                $transaction->type = 2;
                $transaction->tx_id = $factor_number;
                $transaction->save();

                $installment->transaction_id = $transaction->id;
                $installment->save();
            })->pay()->render();

        /*$payir = new PayirPG();
        $payir->amount = ($price) * 10;
        $payir->factorNumber = $factor_number;
        $payir->mobile = auth()->guard('clients')->user()->phone;
        $payir->redirect = route('callback_installment');*/

        /* try {
             $payir->send();
             return redirect($payir->paymentUrl);
         } catch(SendException $e){
             throw $e;
         }*/

    }

    public function callback(Request $request) {

        $auth = $request->Authority;

        try {

            $transaction = Transaction::query()->where('tx_id', '=', $auth)->firstOrFail();

            $receipt = Payment::amount($transaction->amount)->transactionId($auth)->verify();

            $transaction->status = 2;
            $transaction->paid = true;
            $transaction->bank_transaction_id = $auth;
            $transaction->transaction_date = now();
            $transaction->save();

            $t_p = ClientToInstallments::query()->where('transaction_id', $transaction->id)->firstOrFail();

            $t_p->status = 2;
            $t_p->save();

            return view('client.cart.callback', compact('transaction'));

        } catch(InvalidPaymentException $exception) {
            return abort(500);
        }
    }

}
