<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Client;
use App\Models\ClientToMemberShip;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\TransactionAlbum;
use App\Models\TransactionMemberShip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class MembershipController extends Controller {

    public function __invoke(Request $request) {
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        $memberships = Membership::all();



        return view('client.profile.membership', compact('memberships', 'client'));
    }

    public function buy_member_ship($id) {

        $member_ship = Membership::query()->findOrFail($id);

        /*$payir = new PayirPG();
        $payir->amount = ($member_ship->price) * 10;
        $payir->factorNumber = $factor_number;
        $payir->mobile = auth()->guard('clients')->user()->phone;
        $payir->redirect = route('callback_membership');*/

        $invoice = new Invoice;
        $invoice->amount((int)($member_ship->price)/* * 10*/);

        return Payment::callbackUrl(route('callback_membership'))->purchase($invoice,
            function($driver, $transactionId) use ($member_ship, $id) {

                $factor_number = $transactionId;

                $t = Transaction::query()->create([
                    'tx_id' => $factor_number,
                    'amount' => ($member_ship->price)/* * 10*/,
                    'transaction_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'client_id' => auth()->guard('clients')->user()->id,
                    'paid' => false,
                    'status' => 1,
                ]);

                TransactionMemberShip::query()->create([
                    'transaction_id' => $t->id,
                    'membership_id' => $id,
                ]);

            })->pay()->render();

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

            $t_m = TransactionMemberShip::query()->where('transaction_id', $transaction->id)->firstOrFail();

            ClientToMemberShip::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'membership_id' => $t_m->membership_id,
            ]);

            return redirect()->route('profile_membership');
        } catch(InvalidPaymentException $exception) {
            return redirect()->route('home');
        }
    }

}
