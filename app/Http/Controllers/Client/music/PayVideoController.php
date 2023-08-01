<?php

namespace App\Http\Controllers\Client\music;

use App\ClientToVideo;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\TransationProduct;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PayVideoController extends Controller {

    public function pay(Request $request, $video_id) {
        $client_id = auth()->guard('clients')->user()->id;
        $video = Video::query()->findOrFail($video_id);
        if ($video->discount_price)
            $all_price = $video->discount_price;
        else
            $all_price = $video->price;

        $invoice = new Invoice;
        $invoice->amount((int)$all_price);
//        $invoice->detail(['detailName' => setting('cart.gate_description')]);

        return Payment::callbackUrl(route('pay_video_callback'))->purchase($invoice, function($driver, $transactionId) use ($all_price, $client_id, $video) {

            $factor_number = $transactionId;

            $transaction = new Transaction();
            $transaction->amount = $all_price;
            $transaction->client_id = $client_id;
            $transaction->transaction_date = Carbon::now();
            $transaction->status = config('Constants.TransactionStatus.pending');
            $transaction->tx_id = $factor_number;
            $transaction->save();

            $transactionProduct = new TransationProduct();
            $transactionProduct->transaction_id = $transaction->id;
            $transactionProduct->product_id = $video->id;
            $transactionProduct->save();

        })->pay()->render();

        /*$payir = new PayirPG();
        $payir->amount = ($all_price) * 10;
        $payir->factorNumber = $factor_number;
        $payir->mobile = auth()->guard('clients')->user()->phone;
        $payir->redirect = route('pay_video_callback') ;*/

        /*try {
            $payir->send();
            return redirect($payir->paymentUrl);
        } catch(SendException $e) {
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

            $t_p = TransationProduct::query()->where('transaction_id', $transaction->id)->firstOrFail();

            ClientToVideo::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'video_id' => $t_p->product_id,
            ]);

            $video = Video::query()->findOrFail( $t_p->product_id);

            return view('client.cart.callback_video', compact('transaction' , 'video'));
        } catch(InvalidPaymentException $exception) {
            return view('client.cart.callback_failed');
        }
    }

}
