<?php

namespace App\Http\Controllers\Client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ClientToAlbum;
use App\Models\ClientToMusic;
use App\Models\CommentMusic;
use App\Models\Music;
use App\Models\Transaction;
use App\Models\TransactionAlbum;
use App\Models\TransactionMusic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class SingleMusicController extends Controller {

    public function __invoke($slug) {

        $music = Music::findWithSlug($slug)->firstOrFail();
        $music->view += 1;
        $music->save();
        $most_view = Music::query()->whereDoesntHave('music')->orderBy('view')->take(7)->get();

        $has_buy = false;
        if (auth()->guard('clients')->check()) {
            $has_buy = ClientToMusic::query()->where([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'music_id' => $music->id,
                ])->count() > 0;
        }

        return view('client.music.single_music', compact('music', 'most_view' , 'has_buy'));
    }

    public function submit(Request $request) {
        CommentMusic::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'music_id' => $request->music_id,
            'description' => $request->description,
            'is_active' => false
        ]);
        return redirect(url()->previous());

    }

    public function buy_music($id) {

        $music = Music::query()->findOrFail($id);

        if ($music->discount_price != null)
            $price = $music->discount_price;
        else
            $price = $music->price;

        $invoice = new Invoice;
        $invoice->amount((int)($price));

        return Payment::callbackUrl(route('call_back_buy_music'))->purchase($invoice,
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

                TransactionMusic::query()->create([
                    'transaction_id' => $t->id,
                    'music_id' => $id,
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

            $t_p = TransactionMusic::query()->where('transaction_id', $transaction->id)->firstOrFail();

            ClientToMusic::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'music_id' => $t_p->music_id,
            ]);

            $music = Music::query()->findOrFail($t_p->album_id);

            return redirect()->route('single_music' , $music->slug);

//            return view('client.cart.callback_album', compact('transaction', 'album'));

        } catch(InvalidPaymentException $exception) {
            return abort(500);
        }
    }


}
