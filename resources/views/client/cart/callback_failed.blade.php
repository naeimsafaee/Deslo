@extends('client.index')

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>

    <div class="col-lg-12">
        <div id="container" class="container max-height" style="margin-top: unset">

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
                                                پرداخت شما موفقیت آمیز نبود
                                            </h2>

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


@section('class')
    order
@endsection

