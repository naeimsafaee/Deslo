@extends('client.index')

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>

    <div class="col-lg-12">
        <div id="container" class="container max-height">

            <div class="row">
                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="white-box" class="white-box blog-item ">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="submit-pay flex-box center-dive">
                                            <div class="icon-item circle-box">
                                                <img src="{{asset('client/assets/icon/check.svg')}}">
                                            </div>
                                            <h2>
                                                پرداخت شما با موفقیت انجام شد
                                            </h2>
                                            <p>
                                                سفارش شما پس از پردازش تا حداکثر ۴۸ ساعت به دست شما خواهد رسید.
                                                <br/>
                                                در صورتی که هرگونه سوالی در مورد نحوه ارسال دارید با پشتیبانی ما تماس
                                                بگیرید تا به سوالات شما پاسخ داده شود.
                                            </p>
{{--                                            @if()--}}
                                            <h5 class="green">
                                                {{'کد پیگیری شما: ' . $transaction->tx_id }}
                                            </h5>
                                            <a href="{{route('home')}}">
                                                بازگشت به صفحه اصلی
                                            </a>

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

@endsection

@section('top_bar')

    <div class="col-lg-12">
        <div class="scroll order-row">
            <nav class="flex-box">
                <div class="order-level-item flex-box">
                    <img src="{{asset('client/assets/icon/shopping-cart.svg')}}">
                    تایید سبد خرید
                </div>
                <span></span>
                <div class=" order-level-item flex-box">
                    <img src="{{asset('client/assets/icon/truck.svg')}}">
                    انتخاب آدرس و شیوه ارسال
                </div>
                <span></span>

                <div class="order-level-item flex-box">
                    <img src="{{asset('client/assets/icon/wallet.svg')}}">
                    انتخاب روش پرداخت
                </div>
                <span></span>

                <div class="active order-level-item flex-box">
                    <img src="{{asset('client/assets/icon/check2.svg')}}">
                    پرداخت نهایی و اتمام سفارش
                </div>
            </nav>
        </div>
    </div>

@endsection

@section('class')
    order
@endsection

