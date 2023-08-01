@extends('client.index')

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>

    <div class="col-lg-12">
        <div id="container"  class="container max-height">

            <div class="row">
                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <form method="post" action="{{route('cart_pay_installment')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div  class="white-box blog-item ">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="flex-box filter-title">
                                                        <div class="dot flex-box">
                                                            <span></span>
                                                        </div>
                                                        <h2>
                                                            تکمیل اطلاعات برای خرید قسطی
                                                        </h2>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class=" payment-row">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <h4 class="title-information">
                                                                    اطلاعات فردی
                                                                    <div class="underline">

                                                                    </div>
                                                                </h4>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>کد ملی</label>
                                                                    <input type="text" name="national_code" value="{{old('national_code')}}">


                                                                </div>

                                                            </div><div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نام</label>
                                                                    <input type="text" name="first_name" value="{{old('first_name')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نام خانوادگی</label>
                                                                    <input type="text" name="last_name" value="{{old('last_name')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نام پدر</label>
                                                                    <input type="text" name="father_name" value="{{old('father_name')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>موبایل</label>
                                                                    <input type="text" name="mobile" value="{{old('mobile')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>سال تولد</label>
                                                                    <input type="text" class="datepicker" name="birthdate" value="{{old('birthdate')}}">
                                                                    <img src="{{asset('client/assets/icon/calendar.svg')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>جنسیت</label>
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="gender">
                                                                            <option value="0">جنسیت خود را انتخاب نمایید... </option>
                                                                            <option value="{{config('Constants.gender.male')}}">مذکر</option>
                                                                            <option value="{{config('Constants.gender.female')}}">مونث</option>
                                                                        </select>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>شماره شناسنامه</label>
                                                                    <input type="text" name="shenasname_code" value="{{old('shenasname_code')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>ایمیل </label>
                                                                    <input type="text" name="email" value="{{old('email')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>وضعیت تاهل</label>
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="marital_status">
                                                                            <option value="0">جنسیت خود را انتخاب نمایید... </option>
                                                                            <option value="{{config('Constants.marital_status.single')}}">مجرد</option>
                                                                            <option value="{{config('Constants.marital_status.married')}}">متاهل</option>
                                                                        </select>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <h4 class="title-information">
                                                                    اطلاعات بانکی
                                                                    <div class="underline">

                                                                    </div>
                                                                </h4>

                                                            </div>




                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>بانک</label>
                                                                    <input type="text" name="bank" value="{{old('bank')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>شماره حساب جاری دسته چک </label>
                                                                    <input type="text" name="shomare_hesab_jari" value="{{old('shomare_hesab_jari')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>شماره شناسه چک صیاد</label>
                                                                    <input type="text" name="shenase_sayad" value="{{old('shenase_sayad')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>شماره حساب حقوق یا پس انداز </label>
                                                                    <input type="text" name="shomare_hesab" value="{{old('shomare_hesab')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label> حدود مبلغ خرید شما </label>
                                                                    <input type="text" name="purchase_amount_approx" value="{{old('purchase_amount_approx')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label> تاریخ افتتاح حساب </label>
                                                                    <input type="text" class="datepicker" name="bank_account_create_date" value="{{old('bank_account_create_date')}}">
                                                                    <img src="{{asset('client/assets/icon/calendar.svg')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نوع دسته چک</label>
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="daste_check_type">
                                                                            <option value="0">انتخاب نمایید...</option>
                                                                            <option value="{{config('Constants.check_type.shakhsi')}}">شخصی</option>
                                                                            <option value="{{config('Constants.check_type.banki')}}">بانکی</option>
                                                                        </select>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نام و کد شعبه </label>
                                                                    <input type="text" name="shobe_name_and_code" value="{{old('shobe_name_and_code')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>نوع کالا یا خدمتی که قصد خرید دارید و توضیح در صورت لزوم </label>
                                                                    <textarea name="description">{{old('description')}}</textarea>


                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class=" payment-row">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <h4 class="title-information">
                                                                    شغل و آدرس
                                                                    <div class="underline">

                                                                    </div>
                                                                </h4>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>شغل</label>
                                                                    <input type="text" name="job" value="{{old('job')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label> نام شرکت یا محل کار</label>
                                                                    <input type="text" name="company_name" value="{{old('company_name')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>درآمد ماهیانه (تومان)</label>
                                                                    <input type="text" name="monthly_income" value="{{old('monthly_income')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>وضعیت شغلی</label>
                                                                    <div class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="employment_status">
                                                                            <option value="0">وضعیت شغلی  خود را انتخاب نمایید... </option>
                                                                            <option value="{{config('Constants.employment_status.employed')}}">شاغل</option>
                                                                            <option value="{{config('Constants.employment_status.unemployed')}}">بیکار</option>
                                                                        </select>
                                                                    </div>



                                                                </div>

                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>آدرس محل کار</label>
                                                                    <textarea name="company_address">{{old('company_address')}}</textarea>


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>تلفن محل کار ( همراه با کد شهر)</label>
                                                                    <input type="text" name="company_phone" value="{{old('company_phone')}}">


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label> استان </label>
                                                                    <div id="province-select" class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="town_id">
                                                                            <option value="0">استان خود را انتخاب
                                                                                نمایید...
                                                                            </option>
                                                                            @foreach($provinces as $provinc)
                                                                                <option value="{{ $provinc->id }}">{{ $provinc->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error("province")
                                                                    <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label> شهر </label>
                                                                    <div id="city-select" class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="city_id">
                                                                            <option value="0">شهر خود را انتخاب
                                                                                نمایید...
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error("city")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>آدرس منزل</label>
                                                                    <textarea name="home_address">{{old('home_address')}}</textarea>


                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">

                                                                    <label>تلفن منزل ( همراه با کد شهر)</label>
                                                                    <input type="text" name="home_phone" value="{{old('home_phone')}}">

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="aline-left">
                                                            <a href="{{route('cart_pay')}}" class="date">
                                                                رفتن به مرحله قبل
                                                            </a>
                                                            <button class="submit-button">
                                                                <div class="icon-item">
                                                                    <img src="{{asset('client/assets/icon/tick.svg')}}">

                                                                </div>
                                                                پرداخت و ثبت نهایی
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
                    </form>

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


@section('optional_footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').persianDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'YYYY/MM/DD',
                autoClose: true
            })
        });

    </script>


    <script type="text/javascript">
        $(document).ready(function () {

            let cities = @json($cities);

            console.log(cities)
            $('.datepicker').persianDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'YYYY/MM/DD',
                autoClose: true
            })


            $('#province-select').on('change', function () {
                console.log('province changed')
                let provonce_id = $(this).find('select').val()
                let cities_of_this_province = []
                cities.forEach(function (city){
                    if (city.province_id == provonce_id){
                        cities_of_this_province.push(city)
                    }
                })
                console.log('setting cities ' + cities_of_this_province)
                setItems($('#city-select'), cities_of_this_province)

            })
        });


        function setItems(dropdown, items){
            let itemsBox = dropdown.find('.select-items')
            itemsBox.empty()
            let select = dropdown.find('select')
            select.empty()
            items.forEach(function (item){
                let selectedItem = null
                select.append(`<option value="${item.id}">${item.name}</option>`)
                let div = $(`<div>${item.name}</div>`)
                div.click(function () {
                    items.forEach(function (innerItem){
                        if (innerItem.name == div.html()){
                            selectedItem = innerItem
                        }
                    })
                    select.val(selectedItem.id).change();
                    let lable = dropdown.find('.select-selected')
                    lable.html(selectedItem.name)
                })
                itemsBox.append(div)
            })

        }
    </script>
@endsection
@section('class')
    order
@endsection
