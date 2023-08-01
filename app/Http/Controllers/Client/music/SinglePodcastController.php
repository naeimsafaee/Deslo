<?php

namespace App\Http\Controllers\client\music;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ClientToAlbum;
use App\Models\ClientToMemberShip;
use App\Models\ClientToPodcast;
use App\Models\CommentPodcast;
use App\Models\Membership;
use App\Models\MusicCategory;
use App\Models\Podcast;
use App\Models\Transaction;
use App\Models\TransactionAlbum;
use App\Models\TransactionPodcast;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class SinglePodcastController extends Controller {

    public function __invoke($slug) {
        $podcast = Podcast::findWithSlug($slug)->first();
        $podcast->view += 1;
        $podcast->save();

        $most_view = Podcast::orderBy('view')->take(7)->get();

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
        if (auth()->guard('clients')->check()) {
            $has_buy = ClientToPodcast::query()->where([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'podcast_id' => $podcast->id,
                ])->count() > 0;
        }

        return view('client.music.single_podcast', compact('podcast', 'most_view', 'has_membership', 'has_buy'));
    }

    public function submit(Request $request) {
        CommentPodcast::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'podcast_id' => $request->podcast_id,
            'description' => $request->description,
            'is_active' => false,
        ]);
        return redirect(url()->previous());

    }

    public function all($id = false) {

        $categories = MusicCategory::all();
        $is_category = true;
        $category = false;

        if ($id) {
            $videos = Podcast::query()->whereHas('category', function(Builder $query) use ($id) {
                $query->where('category_id', $id);
            })->get();

            $is_category = false;
            $category = MusicCategory::query()->findOrFail($id);

        } else {
            $videos = Podcast::all();
        }

        return view('client.music.all_podcast', compact('videos', 'categories', 'is_category', 'category'));
    }


    public function buy_podcast($id) {

        $album = Podcast::query()->findOrFail($id);

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

        return Payment::callbackUrl(route('call_back_buy_podcast'))->purchase($invoice,
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

                TransactionPodcast::query()->create([
                    'transaction_id' => $t->id,
                    'podcast_id' => $id,
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

            $t_p = TransactionPodcast::query()->where('transaction_id', $transaction->id)->firstOrFail();

            ClientToPodcast::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'podcast_id' => $t_p->podcast_id,
            ]);

            $album = Podcast::query()->findOrFail($t_p->podcast_id);

            return redirect()->route('podcast' , $album->slug);

        } catch(InvalidPaymentException $exception) {
            return redirect()->route('home');
        }
    }


}
