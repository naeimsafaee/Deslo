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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div id="payment-row" class="payment-row">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <form class="row" method="post" action="{{ route('submit_profile_address') }}">
                                                        @csrf

                                                        <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="flex-box add-address">
                                                                <span class="flex-box">
                                                                    <img src="{{ asset('client/assets/icon/plus.svg') }}">
                                                                </span>
                                                                ویرایش آدرس
                                                            </div>

                                                        </div>

                                                        <input type="hidden" name="address_id" value="{{ $address->id }}">

                                                        <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="input-row">
                                                                <input type="text"
                                                                       placeholder=" نام و نام خانوادگی"
                                                                       name="full_name"
                                                                       value="{{ $address->full_name }}">
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
                                                                       name="postal_code"
                                                                       value="{{ $address->postal_code }}">
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
                                                                        <option value="{{ $address->town_id }}">
                                                                            {{ $address->town->name }}
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
                                                                        <option value="{{ $address->city_id }}">
                                                                            {{ $address->city->name }}
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
                                                                            name="address">{{ $address->address }}</textarea>
                                                            </div>
                                                            @error("address")
                                                            <span style="color:red">
                                                                        {{ $message }}
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                        <button class="submit-button">
                                                            <div class="icon-item">
                                                                <img src="{{asset('client/assets/icon/tick.svg')}}">

                                                            </div>
                                                            تایید
                                                        </button>



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
@endsection