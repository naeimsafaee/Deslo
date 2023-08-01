@extends('client.index')

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>

    <div class="col-lg-12">
        <form method="POST" action="{{route('cart_pay')}}">
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
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <h2>
                                                                انتخاب نوع پرداخت
                                                            </h2>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                                        <ul class="unstyled centered">
                                                            <li class="flex-box">
                                                                <input type="radio" name="type"
                                                                       class="styled-checkbox" id="styled-checkbox-1"
                                                                       value="1" checked>
                                                                <label for="styled-checkbox-1">پرداخت آنلاین توسط
                                                                    کارت‌های بانکی</label>
                                                            </li>
                                                            <li class="flex-box">
                                                                <input type="radio" name="type"
                                                                       class="styled-checkbox" id="styled-checkbox-2"
                                                                       value="2">
                                                                <label for="styled-checkbox-2">پرداخت اقساط</label>
                                                                <a target="_blank" href="/pages/installment-conditions" class="curency green">
                                                                    شرایط تایید
                                                                </a>
                                                            </li>
                                                            <li class="flex-box">
                                                                <input type="radio" name="type"
                                                                       class="styled-checkbox" id="styled-checkbox-3"
                                                                       value="3">
                                                                <label for="styled-checkbox-3">پرداخت درب منزل پس از
                                                                    تحویل</label>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <h6>
                                                            هزینه ارسال:<span class="green"> {{ fa_number(number_format($send)) }}  تومان</span>
                                                        </h6>
                                                        <h6>
                                                            مالیت بر ارزش افزوده: <span class="green"> {{ fa_number(setting('cart.maliat')) }} ٪ معادل {{ fa_number(number_format($maliat)) }} تومان</span>
                                                        </h6>
                                                        @if($discount)
                                                            <h6>
                                                                تخفیف: <span class="green">{{ fa_number(number_format($discount)) }}  هزار تومان</span>
                                                            </h6>
                                                        @endif
                                                        <h2 class=" total-payment">
                                                            مجموع سفارش: <span class="green">{{ fa_number(number_format($all_price)) }} تومان</span>
                                                        </h2>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="payment-row">
                                                <div class="row">

                                                    <div class="payMethodBox" style="width: 100%">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="flex-box filter-title">
                                                                <div class="dot flex-box">
                                                                    <span></span>
                                                                </div>
                                                                <h2>
                                                                    انتخاب درگاه پرداخت
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <ul class="unstyled centered">
                                                                <li class="flex-box">
                                                                    <input type="radio" name="gateway"
                                                                           class="styled-checkbox"
                                                                           id="gateway-1" value="1"
                                                                           checked>
                                                                    <label for="gateway-1">درگاه پرداخت زیبال</label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>


                                                    <div class="payMethodBox" style="width: 100%; display: none">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="flex-box filter-title">
                                                                <div class="dot flex-box">
                                                                    <span></span>
                                                                </div>
                                                                <h2>
                                                                    مقدار پیش پرداخت و اقساط
                                                                </h2>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">

                                                            <ul class="unstyled centered">

                                                                @foreach(\App\Models\Installment::all() as $installment)
                                                                    <li class="flex-box">
                                                                        <input type="radio" name="installment"
                                                                               class="styled-checkbox"
                                                                               gateway-1                                                     id="installment-{{ $loop->index }}" value="{{ $installment->id }}">
                                                                        <label for="installment-{{ $loop->index }}">{{ fa_number($installment->title) }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="input-row" id="discount_row">
                                                    <label>کد تخفیف</label>
                                                    <input class="padding-left discountInput" type="text"
                                                           name="discountInput"
                                                           placeholder="کد تخفیف خود را در صورت داشتن وارد نمایید">
                                                    <p id="loading" class="green curency">
                                                        اعمال
                                                    </p>
                                                </div>

                                                <div class="aline-left">
                                                    <a class="date" href="{{ route('cart_address') }}">
                                                        رفتن به مرحله قبل
                                                    </a>
                                                    <button type="submit" class="submit-button" style="border: none;">
                                                        <div class="icon-item">
                                                            <img src="{{asset('client/assets/icon/tick.svg')}}">

                                                        </div>
                                                        پرداخت و ثبت نهایی
                                                    </button>

                                                </div>
                                                {{--                                            </form>--}}

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

@section('optional_footer')

    <script>

        $('input[name="type"]').click(function () {
            var idRadio = $(this).attr("id");
            $(".payMethodBox").hide();
            if (idRadio == 'styled-checkbox-1') {
                $(".payMethodBox").eq(0).show()
                $('#discount_row').show()
            } else if (idRadio == 'styled-checkbox-2') {
                $(".payMethodBox").eq(1).show()
                $('#discount_row').hide()
            } else {
                $(".payMethodBox").eq(2).show()
                $('#discount_row').show()
            }
        })


        $('#loading').click(function () {
            $("#loading").html("\t <div class=\"loading\">\t\n" +
                "\t\t<span class=\"circle\"></span>\n" +
                "\t\t<span class=\"circle\"></span>\n" +
                "\t\t<span class=\"circle\"></span>\n" +
                "\t</div>");


            var discountNo = $(".discountInput").val();
            var token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('discount_cart_pay')}}",
                type: "post",
                data: {_token: token, discountNo: discountNo},

            }).done(function (res) {
                $("#loading").html("اعمال شد!");
                $("#loading").addClass("green");
               // location.reload();
                // console.log(res)
            }).fail(function (err) {
                $("#loading").html(" کد صحیح نیست");
                $("#loading").addClass("red");
            })

        })

    </script>

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

                <div class="active order-level-item flex-box">
                    <img src="{{asset('client/assets/icon/wallet.svg')}}">
                    انتخاب روش پرداخت
                </div>
                <span></span>

                <div class="order-level-item flex-box">
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

