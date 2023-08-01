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
                            درخواست باربری
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
                                            باربری
                                        </h2>
                                        <p>
                                            {{setting('texts.new_pickup_text')}}
                                        </p>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                        <div class="white-box left-item">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="installment flex-box add-order">
                                                        <h4>

                                                            فرم درخواست <span>باربری </span>
                                                        </h4>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <form id="main_form" method="POST"
                                                          action="{{ route('new_pickup_submit') }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label> نام و نام خانوادگی</label>
                                                                    <input type="text" name="name"
                                                                           value="{{old('name')}}">
                                                                </div>
                                                                @error("name")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label> شماره تماس</label>
                                                                    <input type="text" name="phone"
                                                                           value="{{old('phone')}}">
                                                                </div>
                                                                @error("phone")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>مدل پیانو</label>
                                                                    <input type="text" name="model"
                                                                           value="{{old('model')}}">
                                                                </div>
                                                                @error("model")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>نوع پیانو</label>
                                                                    <input type="text" name="piano_type"
                                                                           value="{{old('piano_type')}}">
                                                                </div>
                                                                @error("piano_type")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>نوع درخواست</label>
                                                                    <textarea type="text" name="type"
                                                                              value="{{old('type')}}"></textarea>
                                                                </div>
                                                                @error("type")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label> استان </label>
                                                                    <div id="province-select" class="custom-select">
                                                                        <img src="{{asset('client/assets/icon/angle-left.svg')}}">
                                                                        <select name="province">
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
                                                                        <select name="city">
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
                                                                    <label> آدرس کامل</label>
                                                                    <textarea type="text"
                                                                              name="address">{{old('address')}}</textarea>
                                                                </div>
                                                                @error("address")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="input-row">
                                                                    <label>تعداد طبقات</label>
                                                                    <input type="text" name="floors"
                                                                           value="{{old('floors')}}">
                                                                </div>
                                                                @error("floors")
                                                                <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <button class="submit-button button flex-box ">
                                                                <img src="{{asset('client/assets/icon/white-arrow.svg')}}">
                                                                ثبت درخواست
                                                            </button>
                                                        </div>
                                                    </form>

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
    <script>
        function submit_form() {
            document.getElementById('main_form').submit();
        }


        $(document).ready(function () {

            let cities = @json($cities);

            $('.datepicker').persianDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'YYYY/MM/DD',
                autoClose: true
            })


            $('#province-select').on('change', function () {
                let provonce_id = $(this).find('select').val()
                let cities_of_this_province = []
                cities.forEach(function (city){
                    if (city.province_id == provonce_id){
                        cities_of_this_province.push(city)
                    }
                })
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
