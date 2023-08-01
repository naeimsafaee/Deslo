@extends('client.index')
@section('content')
    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container">

            <div class="row">
                @include('client.profile.profile_detail')
                <div class="space col-lg-9 max-height col-md-7 col-sm-12">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <div id="filter-title" class="flex-box filter-title">
                                <div class="dot flex-box">
                                    <span></span>
                                </div>
                                <h2>
                                    ویرایش اطلاعات پروفایل
                                </h2>

                            </div>
                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box edit">
                                <div class="row">
                                    <div class=" col-lg-5 col-md-12 col-sm-6 col-xs-12">
                                        <form method="post" action="{{ route('profile_edit_submit') }}" id="main_form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-row">
                                                        <label>
                                                            نام و نام خانوادگی
                                                        </label>
                                                        <input name="full_name" type="text" value="{{$client->full_name}}" placeholder="نام و نام خانوادگی خود را وارد نمایید...">
                                                    </div>
                                                </div>
                                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-row">
                                                        <label>
                                                            شماره موبایل
                                                        </label>
                                                        <input name="phone" type="text" value="{{ $client->phone }}" placeholder="شماره موبایل">
                                                    </div>
                                                </div>
                                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-row">
                                                        <label>
                                                            انتخاب عکس
                                                        </label>

                                                        <div class="flex-box yellow-btn file-upload">
                                                            <input class="file-input" type="file" name="avatar" placeholder="نام و نام خانوادگی خود را وارد نمایید...">
                                                            آپلود عکس پروفایل
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="aline-left">
                                                        <a class="margin submit-button button" onclick="submit_form()">
                                                            <img src="{{asset('client/assets/icon/buy-membership.svg')}}">
                                                            ویرایش اطلاعات
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class=" col-lg-7 col-md-12 col-sm-6 col-xs-12">
                                        <img class="profile-edit" src="{{asset('client/assets/icon/edit-profile.svg')}}">
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
        function submit_form(){
            document.getElementById('main_form').submit();
        }
    </script>
    <script>
        $('.file-input').change(function(){
            var curElement = $('.image');
            console.log(curElement);
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                curElement.attr('src', e.target.result);
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
