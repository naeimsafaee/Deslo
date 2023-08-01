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
                        <form id="main_form" action="{{ route('do_verify') }}" method="POST">
                            @csrf
                            <div class="input-row">
                                <label>کد تایید پیامک‌شده به شماره {{ Session('phone') }} را وارد نمایید</label>
                                <div class="row verified">
                                    <div class="verify-input-field-row col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input name="code[]" class="verify-input-field" type="text" data-index="1">
                                    </div>
                                    <div class="verify-input-field-row col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input name="code[]" class="verify-input-field" type="text" data-index="2">
                                    </div>
                                    <div class="verify-input-field-row col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input name="code[]" class="verify-input-field" type="text" data-index="3">
                                    </div>
                                    <div class="verify-input-field-row col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input name="code[]" class="verify-input-field" type="text" data-index="4">
                                    </div>
                                </div>


                            </div>

                            <div class="aline-left">
                                <div class="count-down flex-box" id="countdown" style="direction: ltr;">
                                    <div>
                                        00:
                                    </div>
                                    <div class="count">
                                        59
                                    </div>

                                </div>
                                <a class="submit-button"
                                   onclick="(() => { document.getElementById('main_form').submit(); })()">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/key.svg') }}">
                                    </div>
                                    اعتبارسنجی کد
                                </a>
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
        $(`[data-index=1]`).focus();

        $('.verify-input-field').keypress(function (e) {
            let inputBoxIndex = $(e.target).attr('data-index');
            let inputBox = $(e.target);

            if (inputBox.val().length > 0) {
                e.preventDefault();
            }
        })


        $('.verify-input-field').keyup(function (e) {


            let inputBoxIndex = $(e.target).attr('data-index');
            let pressedKeyCode = e.keyCode | e.which;
            let nextInputBox = $(`[data-index=${Number(inputBoxIndex) + 1}]`);
            let prevInputBox = $(`[data-index=${Number(inputBoxIndex) - 1}]`);

            if (pressedKeyCode !== 8 && pressedKeyCode !== 37 && pressedKeyCode !== 9 && pressedKeyCode !== 16 && nextInputBox.val().length === 0 || pressedKeyCode === 39) {
                nextInputBox.focus();
            } else if (pressedKeyCode === 8 || pressedKeyCode === 37) {
                prevInputBox.focus();
            }

        })
        $('#main_form').keypress((e) => {

            // Enter key corresponds to number 13
            if (e.which === 13) {
                $('#main_form').submit();
            }
        })

    </script>

    <script>
        let i = 59;
        let a = setInterval(function () {
            if (i < 10)
                document.querySelector('.count').textContent = `0${i}`;
            else {
                document.querySelector('.count').textContent = `${i}`
            }
            i--;
            if (i < 0) {
                clearInterval(a);
                $("#countdown").empty();
                $("#countdown").append(`
                                        <a href="{{ route('login') }}">ارسال مجدد کد</a>
                                        `);

            }
        }, 1000)
    </script>

@endsection


