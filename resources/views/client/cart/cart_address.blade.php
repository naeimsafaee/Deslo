@extends('client.index')
@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>

    <div class="col-lg-12">

        <form method="post" action="{{ route('cart_address') }}">
            @csrf

            <div id="container" class="container max-height">

                <div class="row">
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="white-box" class="white-box blog-item ">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div id="payment-row" class="payment-row">
                                                <div class="row">
                                                    <div class="space col-lg-12 col-md-12 col-sm-12">
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <h2>
                                                                آدرس‌های پیشین شما
                                                            </h2>

                                                        </div>
                                                    </div>
                                                    <div class="space col-lg-12 col-md-12 col-sm-12">


                                                        @if($addresses->count() == 0)
                                                            <h5>شما هنوز آدرسی ثبت نکرده اید!</h5>
                                                        @else
                                                            <ul id="unstyled" class="unstyled centered">

                                                                @foreach($addresses as $address)
                                                                    <li class="flex-box">
                                                                        <input type="radio" name="address_id"
                                                                               class="styled-checkbox"
                                                                               id="styled-checkbox-{{ $loop->index }}"
                                                                               value="{{ $address->id }}">
                                                                        <label for="styled-checkbox-{{ $loop->index }}">{{ $address->title }}</label>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        @endif

                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="flex-box add-address">
                                                                <span class="flex-box">
                                                                    <img src="{{ asset('client/assets/icon/plus.svg') }}">
                                                                </span>
                                                                    آدرس جدید
                                                                </div>

                                                            </div>
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-row">
                                                                    <input type="text"
                                                                           placeholder=" نام و نام خانوادگی"
                                                                           name="full_name"/>
                                                                </div>
                                                                @error("full_name")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-row">
                                                                    <input type="text" placeholder="  کد پستی"
                                                                           name="postal_code"/>
                                                                </div>
                                                                @error("postal_code")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-row">
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="town_id">
                                                                            <option value="0">استان خود را انتخاب
                                                                                نمایید...
                                                                            </option>
                                                                            @foreach($provinces as $province)
                                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                @error("town_id")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-row">
                                                                    <div class="custom-select">
                                                                        <img src="{{ asset('client/assets/icon/angle-left.svg') }}">
                                                                        <select name="city_id">
                                                                            <option value="0">شهر خود را انتخاب
                                                                                نمایید...
                                                                            </option>
                                                                            @foreach($cities as $city)
                                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                @error("city_id")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="input-row">
                                                                    <textarea
                                                                            placeholder=" آدرس تحویل "
                                                                            name="address"></textarea>
                                                                </div>
                                                                @error("address")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="payment-row">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <h2>
                                                                روش ارسال
                                                            </h2>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                                        <ul class="centered">
                                                            @if(setting('cart.send_special_price'))
                                                                <li class="flex-box">
                                                                    <input type="radio" name="send"
                                                                           class="styled-checkbox"
                                                                           id="styled-checkbox-3"
                                                                           value="0">
                                                                    <label for="styled-checkbox-3"> پست اکسپرس
                                                                        ( {{ fa_number(number_format(setting('cart.send_special_price'))) }}
                                                                        تومان) </label>
                                                                </li>
                                                            @endif
                                                            @if(setting('cart.send_price'))

                                                                <li class="flex-box">
                                                                    <input type="radio" name="send"
                                                                           class="styled-checkbox"
                                                                           id="styled-checkbox-4"
                                                                           value="1" checked>
                                                                    <label for="styled-checkbox-4">پست پیک
                                                                        ( {{ fa_number(number_format(setting('cart.send_price'))) }}
                                                                        تومان) </label>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="aline-left">
                                                    <a class="date" href="{{ route('cart') }}">
                                                        رفتن به مرحله قبل
                                                    </a>
                                                    <button class="submit-button" type="submit" style="border: none; ">
                                                        <div class="icon-item">
                                                            <img src="{{asset('client/assets/icon/tick.svg')}}">

                                                        </div>
                                                        ثبت و ادامه
                                                    </button>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>

@endsection

@section('top_bar')

    <div class="col-lg-12">
        <div class="scroll order-row">
            <nav class="flex-box">
                <div class="order-level-item flex-box">
                    <img src="{{ asset('client/assets/icon/shopping-cart.svg') }}">
                    تایید سبد خرید
                </div>
                <span></span>
                <div class="active order-level-item flex-box">
                    <img src="{{ asset('client/assets/icon/truck.svg') }}">
                    انتخاب آدرس و شیوه ارسال
                </div>
                <span></span>

                <div class="order-level-item flex-box">
                    <img src="{{ asset('client/assets/icon/wallet.svg') }}">
                    انتخاب روش پرداخت
                </div>
                <span></span>

                <div class="order-level-item flex-box">
                    <img src="{{ asset('client/assets/icon/check2.svg') }}">
                    پرداخت نهایی و اتمام سفارش
                </div>
            </nav>
        </div>
    </div>

@endsection

@section('class')
    order
@endsection
