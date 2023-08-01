<div class="space col-lg-3 col-md-5 col-sm-12">
    <div class="row">
        <div class="{{ request()->route()->getName() != 'profile' ? 'web-filter' : ''}} col-lg-12 col-md-12 col-sm-12">
            <div class="profile-details-item">
                <div class="inner">
                    <div class="image-box">
                        <img class="image" src="{{ get_image($client->image)  }} ">
                    </div>
                    <h5>
                        {{ $client->full_name }}
                    </h5>
                    <p class="email">
                        {{ $client->email }}
                    </p>
                </div>

                <a class="edit-profile flex-box" href="{{ route('profile_edit') }}" style="color: inherit;">
                    <img src="{{ asset ('client/assets/icon/setting.svg')}} ">
                    ویرایش اطلاعات پروفایل
                </a>
            </div>

        </div>
        @if(request()->route()->getName() != 'profile')
            <div class="mobile-filter left-items col-lg-12 col-md-12 col-sm-12">
                <a onclick="window.history.back();" class="submit-filter submit-button go-back">
                    <img src="{{asset ('client/assets/icon/angle-right.svg')}} ">

                    برگشت به عقب

                </a>
            </div>
        @endif
        <div class="{{request()->route()->getName() != 'profile' ? 'web-filter' : ''}} col-lg-12 col-md-12 col-sm-12">
            <div class="profile-details-item">
                <div class="inner">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <h5>
                                پیشخوان حساب کاربری

                            </h5>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_orders') }}" style="color: inherit;">
                                سفارشات
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12  col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_file') }}" style="color: inherit;">
                                فایل های من
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box   p-item" href="{{ route('profile_album') }}" style="color: inherit;">
                                آلبوم های من
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box   p-item" href="{{ route('profile_favorite') }}" style="color: inherit;">
                                علاقه مندی ها
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_address') }}" style="color: inherit;">
                                آدرس ها
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_installments') }}"
                               style="color: inherit;">
                                اقساط
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_comment') }}" style="color: inherit;">
                                نظرات
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_membership') }}"
                               style="color: inherit;">
                                اشتراک ویژه
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                    </div>


                </div>
                <div class="inner">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_pickup') }}" style="color: inherit;">
                                باربری
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <a class="flex-box  p-item" href="{{ route('profile_regulate') }}" style="color: inherit;">
                                کوک و رگلاژ
                                <img src="{{asset ('client/assets/icon/b-arrow.svg')}} ">

                            </a>

                        </div>

                    </div>


                </div>

            </div>
        </div>


    </div>

</div>
