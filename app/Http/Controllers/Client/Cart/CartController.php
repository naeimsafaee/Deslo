<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\ClientProduct;
use App\Models\ClientToInstallments;
use App\Models\ClientToMemberShip;
use App\Models\Discount;
use App\Models\InstallmentInfo;
use App\Models\Product;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\TransactionMemberShip;
use App\Models\TransationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class CartController extends Controller {

    public function __invoke(Request $request) {
        //
    }

    public function cart_installment() {

        $provinces = Province::all();
        $cities = City::all();
        return view('client.cart.cart_installment', compact('provinces', 'cities'));
    }

    public function cart_address() {

        $client_id = Auth::guard('clients')->user()->id;

        $addresses = Address::query()->where('client_id', '=', $client_id)->get();
        $provinces = Province::all();
        $cities = City::all();

        return view('client.cart.cart_address', compact('addresses', 'provinces', 'cities'));
    }

    public function cart_pay(Request $request) {

        $cart = Cart::query()->where('client_id', '=', auth()->guard('clients')->user()->id)->get();

        $final_cart_price = 0;

        foreach($cart as $item) {
            $final_cart_price += $item->product_price;
        }

        $maliat = setting('cart.maliat');

        $send = setting('cart.send_price');
        $discount = false;
        if ($cart->count() > 0) {
            if ($cart->first()->is_discounted === true)
                $discount = Discount::query()->find($cart->first()->discount_id)->value;
            if ($cart->first()->send_type == 0)
                $send = setting('cart.send_special_price');
        }

        $all_price = $discount ? $final_cart_price - $discount : $final_cart_price;

        $maliat = $maliat * $all_price / 100;

        $all_price += $maliat + $send;

        return view("client.cart.cart_pay", compact('send', 'maliat', 'all_price', 'discount', 'final_cart_price'));
    }

    public function add_cart_address(Request $request) {

        if (!$request->address_id) {

            Validator::make($request->all(), [
                'full_name' => ['required'],
                'postal_code' => ['required'],
                'city_id' => ['required', 'not_in:0'],
                'town_id' => ['required', 'not_in:0'],
                'address' => ['required'],
            ], [
                'full_name.required' => "نام و نام خانوادگی خود را وارد کنید",
                'postal_code.required' => "کد پستی خود را وارد کنید",
                'city_id.required' => "شهر خود را انتخاب کنید",
                'city_id.not_in' => "شهر خود را انتخاب کنید",
                'town_id.required' => "استان خود را انتخاب کنید",
                'town_id.not_in' => "استان خود را انتخاب کنید",
                'address.required' => "آدرس خود را وارد کنید",
            ])->validate();

            $address = Address::query()->create([
                "title" => $request->title ?? 'آدرس من',
                "full_name" => $request->full_name,
                "postal_code" => $request->postal_code,
                "city_id" => $request->city_id,
                "town_id" => $request->town_id,
                "address" => $request->address,
                "client_id" => \auth()->guard('clients')->user()->id,
            ]);
        } else {
            $address = Address::query()->findOrFail($request->address_id);
        }

        $send = $request->send;

        $client_id = \auth()->guard('clients')->user()->id;

        $carts = Cart::query()->where('client_id', '=', $client_id)->get();
        foreach($carts as $cart) {
            $cart->send_type = $send;
            $cart->address_id = $address->id;
            $cart->save();
        }
        return redirect()->route('cart_pay');
    }

    public function add_cart_pay(Request $request) {

        $client_id = auth()->guard('clients')->user()->id;
        $cart = Cart::query()->where('client_id', '=', $client_id)->get();
        $discount_id = 0;
        foreach($cart as $item) {
            $item->buy_type = $request->type;
            $item->save();
            $discount_id = $item->discount_id;
        }

        $final_cart_price = 0;

        foreach($cart as $item) {
            $final_cart_price += $item->product_price;
        }

        $maliat = setting('cart.maliat');

        $send = setting('cart.send_price');
        $discount = false;
        if ($cart->count() > 0) {
            if ($cart->first()->is_discounted === true)
                $discount = Discount::query()->find($cart->first()->discount_id)->value;
            if ($cart->first()->send_type == 0)
                $send = setting('cart.send_special_price');
        }

        $all_price = $discount ? $final_cart_price - $discount : $final_cart_price;

        $maliat = $maliat * $all_price / 100;

        $all_price += $maliat + $send;

        $invoice = new Invoice;
        $invoice->amount((int)$all_price);
//        $invoice->detail(['detailName' => setting('cart.gate_description')]);

        /*
        $payir = new PayirPG();
        $payir->amount = ($all_price) * 10;
        $payir->factorNumber = $factor_number;
        $payir->mobile = auth()->guard('clients')->user()->phone;
        $payir->redirect = route('callback_product');*/

        if ($request->type == 1) {

            return Payment::callbackUrl(route('callback_product'))->purchase($invoice,
                function($driver, $transactionId) use ($all_price, $client_id, $request, $cart) {

                    $factor_number = $transactionId;

                    $transaction = new Transaction();
                    $transaction->amount = $all_price;
                    $transaction->client_id = $client_id;
                    $transaction->transaction_date = Carbon::now();
                    $transaction->status = config('Constants.TransactionStatus.pending');
                    $transaction->type = $request->type;
                    $transaction->tx_id = $factor_number;
                    $transaction->save();

                    foreach($cart as $item) {
                        $transactionProduct = new TransationProduct();
                        $transactionProduct->transaction_id = $transaction->id;
                        $transactionProduct->product_id = $item->product_id;
                        $transactionProduct->save();
                    }

                })->pay()->render();
        } elseif ($request->type == 2) {

            $factor_number = rand(100000, 999999);

            $transaction = new Transaction();
            $transaction->amount = $all_price;
            $transaction->client_id = $client_id;
            $transaction->transaction_date = Carbon::now();
            $transaction->status = config('Constants.TransactionStatus.pending');
            $transaction->type = $request->type;
            $transaction->tx_id = $factor_number;
            $transaction->save();

            foreach($cart as $item) {
                $transactionProduct = new TransationProduct();
                $transactionProduct->transaction_id = $transaction->id;
                $transactionProduct->product_id = $item->product_id;
                $transactionProduct->save();
            }

            return redirect()->route('cart_installment');
        } else if ($request->type == 3) {

            $factor_number = rand(100000, 999999);

            $transaction = new Transaction();
            $transaction->amount = $all_price;
            $transaction->client_id = $client_id;
            $transaction->transaction_date = Carbon::now();
            $transaction->status = config('Constants.TransactionStatus.pending');
            $transaction->type = $request->type;
            $transaction->tx_id = $factor_number;
            $transaction->save();

            foreach($cart as $item) {
                $transactionProduct = new TransationProduct();
                $transactionProduct->transaction_id = $transaction->id;
                $transactionProduct->product_id = $item->product_id;
                $transactionProduct->save();
            }

            return view('client.cart.callback');
        }

    }

    public function add_cart_pay_installment(Request $request) {

        $client_id = auth()->guard('clients')->user()->id;
        $cart = Cart::query()->where('client_id', '=', $client_id)->get();
        $discount_id = 0;
        foreach($cart as $item) {
            $item->buy_type = 2;
            $item->save();
            $discount_id = $item->discount_id;
        }

        $transaction = new Transaction();
        $transaction->amount = 0;
        $transaction->client_id = $client_id;
        $transaction->transaction_date = Carbon::now();
        $transaction->status = config('Constants.TransactionStatus.pending');
        $transaction->type = 2;
        $transaction->tx_id = rand(100000, 99999999);
        $transaction->discount_id = $discount_id;
        $transaction->save();

        foreach($cart as $item) {
            $transactionProduct = new TransationProduct();
            $transactionProduct->transaction_id = $transaction->id;
            $transactionProduct->product_id = $item->product_id;
            $transactionProduct->save();
        }

        $info = new InstallmentInfo();
        $info->transaction_id = $transaction->id;
        $info->client_id = \auth()->guard('clients')->user()->id;
        $info->national_code = $request->national_code ?? "";
        $info->first_name = $request->first_name ?? "";
        $info->last_name = $request->last_name ?? "";
        $info->father_name = $request->father_name ?? "";
        $info->mobile = $request->mobile ?? "";
        $info->birthdate = $request->birthdate ?? "";
        $info->gender = $request->gender ?? 0;
        $info->shenasname_code = $request->shenasname_code ?? "";
        $info->email = $request->email ?? "";
        $info->marital_status = $request->marital_status ?? 0;
        $info->purchase_type = $request->purchase_type ?? 0;
        $info->bank = $request->bank ?? 0;
        $info->shomare_hesab_jari = $request->shomare_hesab_jari ?? "";
        $info->shenase_sayad = $request->shenase_sayad ?? "";
        $info->shomare_hesab = $request->shomare_hesab ?? "";
        $info->purchase_amount_approx = $request->purchase_amount_approx ?? "";
        $info->bank_account_create_date = $request->bank_account_create_date ?? "";
        $info->daste_check_type = $request->daste_check_type ?? 0;
        $info->shobe_name_and_code = $request->shobe_name_and_code ?? "";
        $info->description = $request->description ?? "";
        $info->job = $request->job ?? "";
        $info->company_name = $request->company_name ?? "";
        $info->monthly_income = $request->monthly_income ?? "";
        $info->employment_status = $request->employment_status ?? 0;
        $info->company_phone = $request->company_phone ?? "";
        $info->town_id = $request->town_id ?? 0;
        $info->city_id = $request->city_id ?? 0;
        $info->home_address = $request->home_address ?? "";
        $info->home_phone = $request->home_phone ?? "";
        $info->save();

        ClientToInstallments::query()->create([
            'client_id' => \auth()->guard('clients')->user()->id,
            'order' => $transaction->tx_id,
            'price' => 0,
            'status' => 0,
            'time' => Carbon::now()->addMonths(1)->format("Y-m-d H:i:s"),
        ]);

        $id = $transaction->tx_id;

        return view('client.cart.callback', compact('id', 'transaction'));
    }

    public function add_discount_cart_pay(Request $request) {

        $discount = Discount::query()->where('code', $request->discountNo)->where('expire_date', '>', Carbon::today())->get();

        if ($discount && $discount->count() > 0) {

            $client_id = \auth()->guard('clients')->user()->id;

            $carts = Cart::query()->where('client_id', '=', $client_id)->get();
            foreach($carts as $cart) {
                $cart->discount_id = $discount->first()->id;
                $cart->save();
            }

            return response()->json("ok");
        } else {
            return response()->json("bad", 400);
        }
    }

    public function cart($discount_id = false) {

        if (auth()->guard('clients')->check())
            $cart = Cart::query()->where('client_id', '=', auth()->guard('clients')->user()->id)->get();
        else
            $cart = Cart::query()->where('ip', '=', \request()->ip())->where('client_id', '=', null)->get();

        $final_cart_price = 0;

        foreach($cart as $item) {
            if (!$item->product)
                $item->delete();
            $final_cart_price += $item->product_price;
        }

        $maliat = setting('cart.maliat');

        $discount = false;
        if ($cart->count() > 0)
            if ($cart->first()->is_discounted && $cart->first()->is_discounted != "invalid")
                $discount = Discount::query()->find($cart->first()->discount_id)->value;

        $all_price = $discount ? $final_cart_price - $discount : $final_cart_price;

        $maliat = $maliat * $all_price / 100;

        $all_price += $maliat + setting('cart.send_price');

        return view('client.cart.cart', compact('cart', 'final_cart_price', 'maliat', 'discount', 'all_price'));
    }

    public function increase_cart_item($product_id) {

        $product = Product::query()->findOrFail($product_id);

        if (auth()->guard('clients')->check()) {
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "client_id" => auth()->guard('clients')->user()->id,
            ])->first();
        } else {
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "ip" => \request()->ip(),
            ])->first();
        }

        if ($cart->count + 1 > $product->stock) {
            return redirect()->back()->with('warning', 'تنها ' . $product->stock . ' عدد از این محصول در انبار باقی مانده');
        }

        $cart->count++;
        $cart->save();

        return redirect()->route('cart');
    }

    public function remove_cart_item($product_id) {

        if (auth()->guard('clients')->check())
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "client_id" => auth()->guard('clients')->user()->id,
            ])->first(); else
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "ip" => \request()->ip(),
            ])->first();

        if ($cart->count == 1) {
            $cart->delete();
        } else {
            $cart->count--;
            $cart->save();
        }

        return redirect()->route('cart');
    }

    public function delete_cart_item($product_id) {

        $product = Product::query()->findOrFail($product_id);

        if (auth()->guard('clients')->check())
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "client_id" => auth()->guard('clients')->user()->id,
            ])->first(); else
            $cart = Cart::query()->where([
                "product_id" => $product_id,
                "ip" => \request()->ip(),
            ])->first();

        $cart->delete();

        return redirect()->route('cart');
    }

    public function add(Request $request, $id) {

        $client_id = null;
        $ip = null;
        if (auth()->guard('clients')->check()) {
            $client_id = auth()->guard('clients')->user()->id;
        } else {
            $ip = $request->ip();
        }

        $existingCart = Cart::query()->where('product_id', $id)->where('client_id', $client_id)->where('ip', $ip)->first();
        if ($existingCart) {
            return redirect()->back()->with('warning', 'قبلا این آیتم را به سبد خرید خود اضافه کرده اید');
        }
        $product = Product::query()->where('id', $id)->firstOrFail();
        if ($product->stock < intval($request->count)) {
            return redirect()->back()->with('warning', 'تنها ' . $product->stock . ' عدد از این محصول در انبار باقی مانده');
        }

        $cart = Cart::query()->updateOrCreate([
            'client_id' => $client_id,
            'product_id' => $id,
            'ip' => $ip,
            'count' => $request->count ?? 1,
        ]);

        $cart->save();

        return redirect()->route('cart');
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

            ClientProduct::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'product_id' => $t_p->product_id,
            ]);

            return view('client.cart.callback', compact('transaction'));
        } catch(InvalidPaymentException $exception) {
            return view('client.cart.callback_failed');
        }
    }

}
