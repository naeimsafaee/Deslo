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
                                              آلبوم شما با موفقیت خریداری شد
                                                <br>
                                                با تشکر از خرید شما
                                            </p>
{{--                                            @if()--}}
                                            <h5 class="green">
                                                {{'کد پیگیری شما: ' . $transaction->tx_id }}
                                            </h5>
                                            <a href="{{route('album' , $album->slug)}}">
                                                بازگشت به صفحه آلبوم
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


