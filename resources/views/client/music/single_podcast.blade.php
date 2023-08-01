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
                            <div id="white-box" class="white-box  blog-item ">
                                <div class="row padding">
                                    <div class=" col-lg-2 col-md-3 col-sm-4">
                                        <div class="image-box">
                                            <img src="{{ get_image($podcast->image) }}">
                                        </div>

                                    </div>
                                    <div class=" padding2 col-lg-6 col-md-9 col-sm-8">
                                        <h2>
                                            {{ $podcast->title }}
                                        </h2>
                                        <p class="artist-name">
                                            <a href="{{ route('artist' , $podcast->artist->slug) }}"
                                               style="color: inherit;">
                                                {{$podcast->artist->full_name}}
                                            </a>
                                        </p>
                                        <p>
                                            {{ $podcast->description }}
                                        </p>
                                    </div>

                                    @if($has_buy)

                                        <div class="buy-album  col-lg-4 col-md-6 col-md-pull-6 col-sm-12">

                                            <h2>
                                                خریداری شده
                                            </h2>
                                            <div class="flex-box">
                                                <a id="play-online" class="submit-filter submit-button" onclick="togglePlay()" style="justify-content: center;">
                                                    <div class="icon-item">
                                                        <img src="{{asset('client/assets/icon/play2.svg')}}">
                                                    </div>
                                                    پخش آنلاین
                                                </a>
                                                <a class="submit-filter submit-button" href="{{ $podcast->file}}">
                                                    دانلود
                                                </a>

                                            </div>

                                        </div>

                                    @elseif($has_membership && false)

                                        <div class="buy-album  col-lg-4 col-md-6 col-md-pull-6 col-sm-12">
                                            @if($podcast->discount_price > 0)
                                                <h5>
                                                    {{number_format($podcast->price)}} تومان
                                                </h5>
                                                <h2>
                                                    {{number_format($podcast->discount_price)}} تومان
                                                </h2>
                                            @else
                                                <h2>
                                                    {{number_format($podcast->price)}} تومان
                                                </h2>
                                            @endif
                                            <a id="buy-payment" class="submit-filter submit-button" href="{{ route('buy_podcast_with_member_ship' , $podcast->id) }}">
                                                <div class="icon-item">
                                                    <img src="{{ asset('client/assets/icon/play2.svg') }}">
                                                </div>
                                                پخش این پادکست با خرید اشتراک
                                            </a>
                                        </div>

                                    @elseif($podcast->price > 0)
                                        <div class="buy-album  col-lg-4 col-md-6 col-md-pull-6 col-sm-12">
                                            @if($podcast->discount_price > 0)
                                                <h5>
                                                    {{number_format($podcast->price)}} تومان
                                                </h5>
                                                <h2>
                                                    {{number_format($podcast->discount_price)}} تومان
                                                </h2>
                                            @else
                                                <h2>
                                                    {{number_format($podcast->price)}} تومان
                                                </h2>
                                            @endif

                                            <a class="submit-filter submit-button" href="{{ route('buy_podcast' , $podcast->id) }}">
                                                <div class="icon-item">
                                                    <img src="{{asset('client/assets/icon/online-shop.svg')}}">

                                                </div>
                                                پرداخت آنلاین این پادکست
                                            </a>

                                        </div>
                                    @else
                                        <div class="buy-album  col-lg-4 col-md-6 col-md-pull-6 col-sm-12">

                                            <h2>
                                                رایگان
                                            </h2>
                                            <div class="flex-box">
                                                <a id="play-online" class="submit-filter submit-button" onclick="togglePlay()" style="justify-content: center;">
                                                    <div class="icon-item">
                                                        <img src="{{asset('client/assets/icon/play2.svg')}}">

                                                    </div>
                                                    پخش آنلاین
                                                </a>
                                                <a class="submit-filter submit-button" href="{{ $podcast->file}}">
                                                    دانلود
                                                </a>

                                            </div>

                                        </div>
                                    @endif


                                </div>
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-lg-12 col-md-12 col-sm-12">--}}
                                {{--                                        <div class="music-row">--}}
                                {{--                                            <h2>--}}
                                {{--                                                لیست آهنگ ها--}}
                                {{--                                            </h2>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    @foreach($podcast->music as $music)--}}
                                {{--                                        <div class="col-lg-12 col-md-12 col-sm-12">--}}
                                {{--                                            <div class="music-row">--}}
                                {{--                                                <div class="music-item flex-box">--}}
                                {{--                                                    <div class="flex-box">--}}
                                {{--                                                        <div class="image-box">--}}
                                {{--                                                            <img src="{{ get_image($music->image) }}">--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <h2>--}}
                                {{--                                                            {{$music->title}}--}}
                                {{--                                                        </h2>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <div class="flex-box">--}}
                                {{--                                                        <img class="key" src="{{asset('client/assets/icon/key2.svg')}}">--}}
                                {{--                                                        <div class="play-music flex-box">--}}
                                {{--                                                            <img src="{{asset('client/assets/icon/play.svg')}}">--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}

                                {{--                                                </div>--}}

                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endforeach--}}

                                {{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box  blog-item payment-row">
                                @if(auth()->guard('clients')->check())
                                    <form method="post" action="{{ route('submit_podcast') }}" id="main_form">
                                        @csrf
                                        <input type="hidden" value="{{ $podcast->id }}" name="podcast_id">
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
                                @each('components.comment' , $podcast->comments , 'comment')
                            </div>

                        </div>
                    </div>

                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                    <h2>
                                        پربازدید ترین پادکست ها
                                    </h2>
                                </div>

                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="row">
                                    @each('components.podcast' , $most_view , 'podcast')
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
    <div class="audio green-audio-player">
        <div class="play-music flex-box play-pause-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 18 24">
                <path fill="#fff" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"/>
            </svg>
        </div>

        <div class="controls">
            <span class="current-time">0:00</span>
            <div class="slider" data-direction="horizontal">
                <div class="progress">
                    <div class="pin" id="progress-pin" data-method="rewind"></div>
                </div>
            </div>
            <span class="total-time">0:00</span>
        </div>


        <audio crossorigin>
            <source src="{{ $podcast->file }}" type="audio/ogg" >
        </audio>
    </div>
    <script>
        function submit_form() {
            document.getElementById('main_form').submit();
        }
    </script>

    <script src="{{asset('client/assets/js/audio-player.js')}}"></script>

@endsection

