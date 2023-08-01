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
                    <div class="content-row">
                        <form method="POST" action="{{ route('do_login') }}">
                            @csrf
                            <div class="input-row">
                                <label>شماره موبایل:</label>
                                <input name="phone" class="input-number" type="text">
                                <img src="{{ asset('client/assets/icon/mobile.svg') }}">
                                <span></span>

                            </div>
                            <div class="aline-left">
                                <button class="submit-button">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/tick.svg') }}">
                                    </div>
                                    ارسال کد تایید
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
