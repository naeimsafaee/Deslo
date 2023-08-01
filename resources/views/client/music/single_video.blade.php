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
                        <a>
                            صفحه اصلی
                        </a>
                        <a class="arrow">
                            >
                        </a>
                        <a>
                            پیانو
                        </a>
                        <a class="arrow">
                            >
                        </a>
                        <a class="green">
                            آهنگ
                        </a>
                    </div>
                </div>

                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box   ">
                                <div class="row padding2">
                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                        {{--<div class="image-box">
                                            <img src="{{ get_image($video->image) }}">
                                        </div>--}}
                                        <div class="padding-item col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="single-image-box" style="max-width: 1221px; margin: auto">
                                                <div id="player"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="margin col-lg-12 col-md-12">
                                        <div class="title-item flex-box">
                                            <div class="row">
                                                <div class=" flex-box col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                                    <div>
                                                        <h2>
                                                            {{ $video->title }}
                                                        </h2>
                                                        <p class="artist-name">
                                                            {{ $video->category->first()->title }}
                                                        </p>
                                                    </div>
                                                </div>

                                                @if($video->price >0 && $video->pay==false)
                                                    <div class="buy-album  col-lg-4 col-md-6 col-md-pull-6 col-sm-12">
                                                        @if($video->discount_price>0)
                                                            <h5>
                                                                {{number_format($video->price)}} تومان

                                                            </h5>
                                                            <h2>
                                                                {{number_format($video->discount_price)}} تومان
                                                            </h2>
                                                        @else
                                                            <h2>
                                                                {{number_format($video->price)}} تومان
                                                            </h2>
                                                        @endif

                                                        <a class="submit-filter submit-button" href="{{ route('pay_video' , $video->id) }}">
                                                            <div class="icon-item">
                                                                <img src="{{asset('client/assets/icon/online-shop.svg')}}">

                                                            </div>
                                                            پرداخت آنلاین این موزیک ویدئو
                                                        </a>

                                                    </div>
                                                @else
                                                    <div class=" col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                        <a href="{{$video->file}}" style="margin: 0"
                                                           class="submit-button submit-filter  ">
                                                            دانلود فایل
                                                        </a>

                                                    </div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box  blog-item payment-row">
                                @if(auth()->guard('clients')->check())
                                    <form method="post" action="{{ route('submit_video') }}" id="main_form">
                                        @csrf
                                        <input type="hidden" value="{{ $video->id }}" name="video_id">
                                        <div class="input-row">
                                            <textarea placeholder=" نظر خودتان را بنویسید"
                                                      name="description"></textarea>
                                        </div>
                                        <div class="aline-left">
                                            <a id="submit-massege" class="submit-filter submit-button"
                                               onclick="submit_form()">
                                                <div class="icon-item">
                                                    <img src="{{asset('client/assets/icon/filter.svg')}}">
                                                </div>
                                                ارسال دیدگاه
                                            </a>
                                        </div>
                                    </form>
                                @else
                                    <p>برای ارسال دیدگاه ابتدا وارد حساب کاربری خود شوید</p>
                                @endif
                                @each('components.comment' , $video->comments , 'comment')
                            </div>

                        </div>
                    </div>

                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                    <h2>
                                        تازه ترین موزیک مرتبط
                                    </h2>
                                </div>

                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="row">
                                    @each('components.video' , $new , 'video')
                                </div>


                            </div>
                        </div>

                    </div>
                    <div style="height: 200px">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{asset('client/assets/js/playerjs2.js')}}"></script>

    <script>
        function submit_form() {
            document.getElementById('main_form').submit();
        }
    </script>

    <script>
        var player = new Playerjs(
            {
                id: "player",
                file: "{{ $video->file }}",
                // poster:'آدرس پوستر
            }
        );
    </script>
@endsection
