@extends('auth.index')

@section('content')

    <div class="bg-image container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="login-form">
                    <div class="logo-row">
                        <img src="{{ get_image(setting('site.logo')) }}">
                        <h5>
                            {{ setting('site.title') }}
                        </h5>
                    </div>

                    <div id="content-row" class="content-row">
                        <form method="POST" action="{{ route('profile.register') }}" id="main_form">
                            @csrf
                            <div id="legal-person-input" class="form-group">
                                <input name="is_hoghoghi"  type="checkbox" id="checkbox1" {{ old('is_hoghoghi') }}>
                                <label for="checkbox1">فرد حقوقی هستم</label>
                            </div>
                            <div class="legal-person">
                                <div class="input-row">
                                    <label> نام شرکت</label>
                                    <input name="company_name" type="text" placeholder=" نام شرکت خود را وارد نمایید..." value="{{ old('company_name') }}">
                                </div>
                                <div class="input-row">
                                    <label>کد اقتصادی</label>
                                    <input name="eghtesadi_code" type="text" placeholder="کد اقتصادی خود را وارد نمایید..." value="{{ old('eghtesadi_code') }}">
                                </div>
                                <div class="input-row">
                                    <label>شناسه ملی</label>
                                    <input name="shenase_melli" type="text" placeholder="شناسه ملی خود را وارد نمایید..." value="{{ old('shenase_melli') }}">
                                </div>
                                <div class="input-row">
                                    <label>شماره ثبت</label>
                                    <input name="sabt_number" type="text" placeholder="شماره ثبت خود را وارد نمایید..." value="{{ old('sabt_number') }}">
                                </div>
                                <div class="input-row">
                                    <label>شماره ثابت</label>
                                    <input name="landline_phone" type="text" placeholder="شماره ثابت را وارد نمایید..." value="{{ old('home_phone') }}">
                                </div>
                                <div class="input-row">
                                    <label>آدرس دفتر</label>
                                    <textarea name="address" type="text" placeholder="آدرس دفتر را وارد نمایید...">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="normal-person">
                                <div class="input-row">
                                    <label>نام و نام خانوادگی</label>
                                    <input name="full_name" type="text" placeholder="نام و نام خانوادگی خود را وارد نمایید..." value="{{ old('full_name') }}">
                                </div>
                                <div class="input-row">
                                    <label>تاریخ تولد</label>
                                    <input name="birthdate" class="input-number datepicker" type="text" value="{{ old('birthdate') }}">
                                    <img src="{{ asset('client/assets/icon/calendar.svg') }}">
                                </div>
                                <div class="input-row">
                                    <label> کد ملی</label>
                                    <input name="melli_code" type="text" placeholder=" کد ملی خود را وارد نمایید..." value="{{ old('melli_code') }}">
                                </div>
                                <div class="form-group">
                                    <input name="is_foreign" type="checkbox" id="checkbox2" {{ old('is_hoghoghi') }}>
                                    <label for="checkbox2"> اتباع خارجی هستم</label>
                                </div>
                                <div class="input-row">
                                    <label> شماره منزل </label>
                                    <input name="home_phone" type="text" placeholder=" شماره منزل خود را وارد نمایید..." value="{{ old('landline_phone') }}">
                                </div>
                                <div class="input-row">
                                    <label> آدرس ایمیل </label>
                                    <input name="email" type="text" placeholder=" آدرس ایمیل خود را وارد نمایید..." value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="aline-left">
                                <button class="submit-button">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/tick.svg') }}">
                                    </div>
                                    تایید عضویت
                                </button>
                            </div>
                        </form>

                        <a class="link" href="{{ route('home') }}">
                            <h5 class="text-center">
                                بازگشت به صفحه اصلی
                            </h5>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('optional_footer')

    <script>
        $('#checkbox1').click(function() {
            if(document.getElementById('checkbox1').checked) {
                $(".legal-person").show();
                $(".normal-person").hide();
            } else {
                $(".legal-person").hide();
                $(".normal-person").show();
            }
        })


    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').persianDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'YYYY/MM/DD',
                autoClose: true
            })
        });
    </script>
@endsection
