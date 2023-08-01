@extends('client.index')
@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container max-height">

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
                            خرید اقساطی
                        </a>
                    </div>
                </div>

                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box blog-item blog-single-item">
                                <div class="row">
                                    <div class="padding-left-item col-lg-7 col-md-6 col-sm-12">
                                        <h2>
                                            خرید اقساطی
                                        </h2>
                                        <p>
                                            {{ setting('texts.installment_text') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                        <div class="white-box left-item">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="installment flex-box add-order">
                                                        <h4>
                                                            محاسبه‌گر <span>اقساط</span>
                                                        </h4>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>قیمت کالای مورد نظر</label>
                                                                    <input class="padding-left digit" id="price"
                                                                           pattern="\d{2},\d{2}">
                                                                    <p class="curency">
                                                                        تومان
                                                                    </p>
                                                                    <span></span>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <div class="flex-box add-order">
                                                                        <label> مبلغ پیش پرداخت مورد نظر</label>
                                                                        <p class="green" id="30_darsad">
                                                                            حداقل ۳۰٪ مبلغ کالا
                                                                        </p>
                                                                    </div>
                                                                    <input class="padding-left digit"
                                                                           id="prepay_amount">
                                                                    <p class="curency">
                                                                        تومان
                                                                    </p>
                                                                    <span></span>

                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>پلن اقساط خود را انتخاب کنید</label>
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select id="selected_installment">
                                                                            <option>انتخاب کنید</option>
                                                                            @foreach($installments as $installment)
                                                                                <option value="{{$installment->id}}">{{$installment->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>


                                                                </div>

                                                            </div>

                                                            <script>
                                                                $(document).ready(function () {
                                                                    $(".digit").on("change, mouseup, mousedown, click, focus, touchend, keyup", function () {
                                                                        if ($(this).val().length === 0)
                                                                            return;
                                                                        let num = $(this).val().toString().replace(",", "").replace(",", "").replace(",", "").replace(",", "").split("").reverse().join("").replace(/(\d{3})(?=\d)/g, "$1,").split("").reverse().join("");

                                                                        $(this).val(num);
                                                                    });
                                                                });
                                                            </script>


                                                        </div>


                                                    </form>

                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="installment flex-box add-order">
                                                        <div>
                                                            <p>
                                                                مبلغ هر قسط:
                                                            </p>
                                                            <h4>
                                                                <span id="each_installment_text">۰</span> تومان
                                                            </h4>
                                                        </div>
                                                        <div>
                                                            <p>
                                                                مبلغ پرداختی کل شما:
                                                            </p>
                                                            <h4>
                                                                <span id="total_text">۰</span> تومان
                                                            </h4>
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

                </div>
            </div>

        </div>
    </div>

@endsection

@section('optional_footer')
    <script>

        $(".select-items div").click(() => {
            calculate()
        })

        function calculate() {
            let price = parseInt($('#price').val().trim().replace(",", "").replace(",", "").replace(",", "").replace(",", "")) || 0
            let prepay = parseInt($('#prepay_amount').val().trim().replace(",", "").replace(",", "").replace(",", "").replace(",", "")) || 0

            if(price * 30 / 100 > prepay){

                $("#30_darsad").attr('style' , 'color: red !important')
                $("#each_installment_text").text("۰")
                $("#total_text").text("۰")
                return;
            }

            $("#30_darsad").attr('style' , 'color: #00AB57 !important')


            let installments = @json($installments);

            let selected_installment = null
            installments.forEach(function (item) {
                if (item.id == $('#selected_installment').val()) {
                    selected_installment = item
                }
            })

            if (selected_installment) {
                let to_pay = price - prepay

                let interest = (selected_installment.darsad / 100) * to_pay

                let total = Math.trunc(to_pay + interest)

                let montly = Math.trunc(total / selected_installment.number_of_month)

                total += prepay

                let formatter = new Intl.NumberFormat('fa-IR', {
                    style: 'currency',
                    currency: 'IRR',
                    minimumFractionDigits: 0
                });
                $('#each_installment_text').text(
                    formatter.format(montly).replace('ریال', '')
                )
                $('#total_text').text(
                    formatter.format(total).replace('ریال', '')
                )

            }

        }


        // Restricts input for the given textbox to the given inputFilter.
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
                textbox.addEventListener(event, function () {

                    if (typeof this.oldValue === "undefined")
                        return;

                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                });
            });
        }


        // Install input filters.
        setInputFilter(document.getElementById("price"), function (value) {
            return true;
            // return /^-?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("prepay_amount"), function (value) {
            return true;
            // return /^-?\d*$/.test(value);
        });


        $('input').on('keyup', function () {
            calculate()
        })
        $('select').change(function () {
            calculate()
        })

    </script>
@endsection
