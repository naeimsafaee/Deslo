<?php

namespace App\Http\Controllers\Client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ClientProduct;
use App\Models\ClientToAlbum;
use App\Models\ClientToMemberShip;
use App\Models\ClientToPodcast;
use App\Models\CommentAlbum;
use App\Models\Membership;
use App\Models\Podcast;
use App\Models\Transaction;
use App\Models\TransactionAlbum;
use App\Models\TransationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class SingleAlbumController extends Controller {

    public function __invoke($slug) {

        $album = Album::findWithSlug($slug)->first();
        $album->view += 1;
        $album->save();

        $most_view = Album::orderBy('view')->take(7)->get();

        $has_membership = false;
        if (auth()->guard('clients')->check()) {

            $member = ClientToMemberShip::query()->where([
                'client_id' => auth()->guard('clients')->user()->id,
            ])->first();

            if ($member) {
                $member_ship = Membership::query()->find($member->membership_id);

                if (Carbon::createFromFormat('Y-m-d H:i:s', $member->created_at)->addDays($member_ship->month)->isPast()) {
                    $member->delete();
                } else {
                    $has_membership = true;
                }
            }

        }

        $has_buy = false;
        if (auth()->guard('clients')->check() ) {
            $has_buy = ClientToAlbum::query()->where([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'album_id' => $album->id,
                ])->count() > 0;
        }

        return view('client.music.single_album', compact('has_buy', 'album', 'most_view', 'has_membership'));
    }

    public function submit(Request $request) {
        CommentAlbum::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'album_id' => $request->album_id,
            'description' => $request->description,
            'is_active' => false,
        ]);
        return redirect(url()->previous());

    }

    public function buy_album($id) {

        $album = Album::query()->findOrFail($id);

        if ($album->discount_price != null)
            $price = $album->discount_price;
        else
            $price = $album->price;

        /* $payir = new PayirPG();
         $payir->amount = ($price) * 10;
         $payir->factorNumber = $factor_number;
         $payir->mobile = auth()->guard('clients')->user()->phone;
         $payir->redirect = route('call_back_buy_album');*/

        $invoice = new Invoice;
        $invoice->amount((int)($price));

        return Payment::callbackUrl(route('call_back_buy_album'))->purchase($invoice,
            function($driver, $transactionId) use ($price, $id) {

                $factor_number = $transactionId;

                $t = Transaction::query()->create([
                    'tx_id' => $factor_number,
                    'amount' => ($price) * 10,
                    'transaction_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'client_id' => auth()->guard('clients')->user()->id,
                    'paid' => false,
                    'status' => 1,
                ]);

                TransactionAlbum::query()->create([
                    'transaction_id' => $t->id,
                    'album_id' => $id,
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

            $t_p = TransactionAlbum::query()->where('transaction_id', $transaction->id)->firstOrFail();

            ClientToAlbum::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'album_id' => $t_p->album_id,
            ]);

            $album = Album::query()->findOrFail($t_p->album_id);

            return view('client.cart.callback_album', compact('transaction', 'album'));

        } catch(InvalidPaymentException $exception) {
            return abort(500);
        }
    }

    public function buy_album_with_member_ship($id) {

        $album = Album::query()->findOrFail($id);

        $member_ship = ClientToMemberShip::query()->where([
            'client_id' => auth()->guard('clients')->user()->id,
        ])->first();

        if ($member_ship) {

            $_member_ship = Membership::query()->find($member_ship->membership_id);

            if (Carbon::createFromFormat('Y-m-d H:i:s', $member_ship->created_at)->addDays($_member_ship->month)->isPast()) {

                $member_ship->delete();

                return redirect()->route('member_ship_is_gone');
            } else {

                ClientToAlbum::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'album_id' => $album->id,
                ]);

                return redirect()->back();
            }

        } else {
            return abort(404);
        }

    }

    public function buy_podcast_with_member_ship($id) {

        $album = Podcast::query()->findOrFail($id);

        $member_ship = ClientToMemberShip::query()->where([
            'client_id' => auth()->guard('clients')->user()->id,
        ])->first();

        if ($member_ship) {

            $_member_ship = Membership::query()->find($member_ship->membership_id);

            if (Carbon::createFromFormat('Y-m-d H:i:s', $member_ship->created_at)->addDays($_member_ship->month)->isPast()) {

                $member_ship->delete();

                return redirect()->route('member_ship_is_gone');
            } else {

                ClientToPodcast::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'podcast_id' => $album->id,
                ]);

                return redirect()->back();
            }

        } else {
            return abort(404);
        }

    }

}
