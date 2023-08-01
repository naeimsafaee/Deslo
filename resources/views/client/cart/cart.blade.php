@extends('client.index')
@section('content')
    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container max-height">
            @if(count($cart) > 0)
                <div class="row">
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="flex-box back-item">
                            <a href="{{route('home')}}">
                                صفحه اصلی
                            </a>
                            <a class="arrow">
                                >
                            </a>
                            <a class="green">
                                سبد خرید
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class=" col-lg-8 col-md-7 col-sm-12">


                                <div class="row">
                                    @foreach($cart as $item)
                                        @if($item->product)
                                            <div class="space col-lg-12 col-md-12 col-sm-12">
                                                <div class="white-box blog-item orders">
                                                    <div class="" style="padding: 10px;">
                                                        <div class="row">
                                                            <div class=" col-lg-8 col-md-12 col-sm-6">
                                                                <div class="flex-box order-item basket-item">
                                                                    <img src="{{ get_image($item->product->main_image) }}">
                                                                    <div class="order-content flex-box">
                                                                        <div>
                                                                            <h2>
                                                                                {{ $item->product->name }}
                                                                            </h2>
                                                                            <p class="date">
                                                                                {{ $item->product->sub_title }}
                                                                            </p>
                                                                        </div>

                                                                        <div class=" add-order">
                                                                            <div class="flex-box add-remove">
                                                                                <p class="text-center grey">
                                                                                    تعداد
                                                                                </p>
                                                                                <div class="flex-box">
                                                                                <span class="add flex-box"><a
                                                                                            href="{{ route('increase_cart_item' , $item->product->id) }}"
                                                                                            style="color: inherit!important;">+</a></span>
                                                                                    <span>{{ fa_number($item->count) }}</span>
                                                                                    <span class="remove flex-box"><a
                                                                                                href="{{ route('remove_cart_item' , $item->product->id) }}"
                                                                                                style="color: inherit!important;">-</a></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="price-details-parent col-lg-4 col-md-12 col-sm-6">
                                                                <div class=" price-details" style="margin: 0px !important;">
                                                                    <div class="image-box flex-box">
                                                                        <a href="{{ route('delete_cart_item' ,  $item->product->id) }}">
                                                                            <img src="{{asset('client/assets/icon/trash.svg')}}">
                                                                        </a>

                                                                    </div>
                                                                    <h5>
                                                                        قیمت واحد:
                                                                        <span class="green">
                                                                 {{ fa_number(number_format($item->product->final_price)) }} تومان
                                                            </span>
                                                                    </h5>
                                                                    <h5>
                                                                        قیمت کل:
                                                                        <span class="green">
                                                                 {{ fa_number(number_format($item->product_price)) }} تومان
                                                            </span>
                                                                    </h5>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>


                            </div>
                            <div class="space col-lg-4 col-md-5 col-sm-12 margin">
                                <h2>
                                    خلاصه فاکتور
                                </h2>
                                @if($cart->count() > 0)
                                    <div class="row">
                                        <div class=" col-lg-12 col-md-12 col-sm-12">
                                            <div id="white-box" class="white-box blog-item ">
                                                <div class="inner">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <h6>
                                                            هزینه ارسال:<span class="green"> {{ fa_number(number_format(setting('cart.send_price'))) }}  تومان</span>
                                                        </h6>
                                                        <h6>
                                                            مالیت بر ارزش افزوده: <span class="green"> {{ fa_number(setting('cart.maliat')) }} ٪ معادل {{ fa_number(number_format($maliat)) }} تومان</span>
                                                        </h6>
                                                        @if($discount)
                                                            <h6>
                                                                تخفیف: <span class="green">{{ fa_number(number_format($discount)) }}  هزار تومان</span>
                                                            </h6>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div id="inner" class="inner">
                                                    <div class=" price-details">
                                                        <h5>
                                                            مجموع سبد:
                                                            <span class="green">
                                                                 {{ fa_number(number_format($final_cart_price)) }} تومان
                                                            </span>
                                                        </h5>
                                                        <h5>
                                                            مجموع کل:
                                                            <span class="green">
                                                                 {{ fa_number(number_format($all_price)) }} تومان
                                                            </span>
                                                        </h5>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class=" col-lg-12 col-md-12 col-sm-12">
                                            <a class="submit-filter submit-button" href="{{ route('cart_address') }}">
                                                <div class="icon-item">
                                                    <img src="{{ asset('client/assets/icon/tick.svg') }}">

                                                </div>
                                                پرداخت و ثبت خرید
                                            </a>
                                        </div>

                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            @else
                <div class="row">
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="flex-box center-dive">
                                    <div class="icon-item circle-box">
                                        <img src="{{asset('client/assets/icon/green%20basket.svg')}}">
                                    </div>
                                    <h2>
                                        سبد خرید شما خالی است
                                    </h2>
                                    <a class="submit-button" href="{{ route('home') }}">
                                        <div class="icon-item">
                                            <img src="{{asset('client/assets/icon/tick.svg')}}">

                                        </div>
                                        رفتن به صفحه اصلی
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

