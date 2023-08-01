@extends('client.index')

@section('content')

    <div class="fade-page"></div>

    <div class="overlay">
    </div>


    {{--SLIDER--}}
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 owl-row">
                <div id="container" class="container">
                    <div class="contain">

                        <div id="owl-carousel" class="owl-carousel owl-theme homeSlder">
                            @each('components.slider', $sliders, 'slider')
                        </div>

                        @if(count($sliders) > 1)
                            <div class="btns">
                                <div class="customNextBtn"><img src="{{ asset('client/assets/icon/angle-left.svg')}}">
                                </div>
                                <div class="customPreviousBtn"><img
                                            src="{{ asset('client/assets/icon/angle-right.svg')}}"></div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="container" class="container" style="padding-top: 0">

            @foreach($homes as $home)

                @if($home->type == "service")
                    <div class="row margin scroll">
                        @each('components.service', $home->items, 'service')
                    </div>
                @elseif($home->type == "product")
                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/f-v.svg')  }}">
                                    <h2>
                                        {{ $home->title }}
                                    </h2>
                                </div>

                                <a class="submit-button button flex-box "
                                   href="{{ route('search', ['category' => $home->sub_category_id]) }}">
                                    <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                    مشاهده همه
                                </a>
                            </div>
                        </div>
                        <div class="row  ">
                            <div class="nav-row space col-lg-12 col-md-12">
                                <div class="product-owl-carousel owl-carousel owl-theme owl-loaded owl-drag"
                                     id="new-product-owl-carousel">
                                    @each('components.small_product' , $home->items , 'product')
                                </div>
                            </div>
                        </div>

                    </div>
                @elseif($home->type == "book")
                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/f-v.svg')  }}">
                                    <h2>
                                        {{ $home->title }}
                                    </h2>
                                </div>
                                <a class="submit-button button flex-box "
                                   href="{{ route('search', ['search_in' => 'books']) }}">
                                    <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                    همه کتاب ها

                                </a>
                            </div>
                        </div>

                        <div class="nav-row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="book-owl-carousel" class="book-owl-carousel owl-carousel owl-theme">
                                @each('components.small_product' , $home->items , 'product')
                            </div>
                        </div>

                    </div>
                @elseif($home->type == "album")
                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/Ticket%20Star.svg')  }}">
                                    <h2>
                                        {{ $home->title }}
                                    </h2>
                                </div>
                                <a class="submit-button button flex-box "
                                   href="{{ route('all_album') }}">
                                    <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                    همه آلبوم ها

                                </a>

                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="row">

                                    @each('components.album' , $home->items , 'album')

                                </div>
                            </div>
                        </div>

                    </div>
                    @if(setting('site.newest_song') > 0)
                        <div class="row margin">
                            <div class="space col-lg-12 col-md-12">
                                <div class="title-item flex-box">
                                    <div class="flex-box">
                                        <img src="{{ asset('client/assets/icon/Ticket%20Star.svg')  }}">
                                        <h2>
                                            تازه ترین اهنگ ها
                                        </h2>
                                    </div>
                                    <a class="submit-button button flex-box "
                                       href="{{ route('all_music') }}">
                                        <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                        همه اهنگ ها
                                    </a>

                                </div>
                            </div>
                            <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="white-box">
                                    <div class="row">

                                        @each('components.music' , \App\Models\Music::query()->whereDoesntHave('music')->take(setting('site.newest_song'))->orderBy('created_at' , 'DESC')->get(), 'music')

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                @elseif($home->type == "banner")
                    <div class="row margin">
                        @each('components.banner' , $home->items , 'banner')
                    </div>
                @elseif($home->type == "brand")
                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/Star.svg')  }}">
                                    <h2>
                                        {{ $home->title }}
                                    </h2>
                                </div>
                                {{--todo<a class="submit-button button flex-box ">
                                    <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                    مشاهده لیست کامل
                                </a>--}}

                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12">
                            <div class="brand-nav-row nav-row white-box">
                                <div id="brand-owl-carousel" class="owl-carousel owl-theme" style="margin-left: 15px;">

                                    @each('components.brand' , $home->items , 'brand')
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($home->type == "banner2")
                    <div class="row margin">
                        <div class=" col-lg-3 col-md-5 col-sm-12 col-xs-12">
                            <div class="row">
                                @if($home->items->count() > 0)
                                    <a href="{{$home->items->first()->link}}"
                                       class="space col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <div class="gallery-item image-box medium">
                                            <img src="{{ get_image($home->items->first()->image)  }}">
                                            <div class="initial">
                                                <h6>
                                                    {{ $home->items->first()->title }}
                                                </h6>
                                            </div>
                                        </div>

                                    </a>
                                @endif
                                @if($home->items->count() > 3)
                                    <a href="{{$home->items->skip(3)->first()->link}}"
                                       class="space col-lg-12 col-md-12  col-sm-6 col-xs-12">
                                        <div class="gallery-item image-box medium">
                                            <img src="{{ get_image($home->items->skip(3)->first()->image) }}">
                                            <div class="initial">
                                                <h6>
                                                    {{ $home->items->skip(3)->first()->title }}
                                                </h6>
                                            </div>
                                        </div>

                                    </a>
                                @endif
                            </div>
                        </div>
                        @if($home->items->count() > 2)
                            <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12">
                                <div class="row">
                                    @if($home->items->count() > 1)
                                        <a href="{{$home->items->skip(1)->first()->link}}"
                                           class="space col-lg-7 col-md-6 col-sm-6 col-xs-12">
                                            <div class="gallery-item image-box medium">
                                                <img src="{{ get_image($home->items->skip(1)->first()->image)  }}">
                                                <div class="initial">
                                                    <h6>
                                                        {{ $home->items->skip(1)->first()->title }}
                                                    </h6>
                                                </div>
                                            </div>

                                        </a>
                                    @endif
                                    @if($home->items->count() > 2)
                                        <a href="{{$home->items->skip(2)->first()->link}}"
                                           class="space col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                            <div class="gallery-item image-box medium">
                                                <img src="{{ get_image($home->items->skip(2)->first()->image)  }}">
                                                <div class="initial">
                                                    <h6>
                                                        {{ $home->items->skip(2)->first()->title }}
                                                    </h6>
                                                </div>
                                            </div>

                                        </a>
                                    @endif
                                </div>
                                <div class="row">
                                    @if($home->items->count() > 4)
                                        <a href="{{$home->items->skip(4)->first()->link}}"
                                           class="space col-lg-5 col-md-4 col-sm-4 col-xs-12">
                                            <div class="gallery-item image-box medium">
                                                <img src="{{ get_image($home->items->skip(4)->first()->image)  }}">
                                                <div class="initial">
                                                    <h6>
                                                        {{$home->items->skip(4)->first()->title}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    @if($home->items->count() > 5)
                                        <a href="{{$home->items->skip(5)->first()->link}}"
                                           class="space col-lg-5 col-md-4 col-sm-4 col-xs-12">
                                            <div class="gallery-item image-box medium">
                                                <img src="{{ get_image($home->items->skip(5)->first()->image)  }}">
                                                <div class="initial">
                                                    <h6>
                                                        {{$home->items->skip(5)->first()->title}}
                                                    </h6>
                                                </div>
                                            </div>

                                        </a>
                                    @endif
                                    @if($home->items->count() > 6)
                                        <a href="{{$home->items->skip(6)->first()->link}}"
                                           class="space col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <div class="gallery-item image-box medium">
                                                <img src="{{  get_image($home->items->skip(6)->first()->image)  }}">
                                                <div class="initial">
                                                    <h6>
                                                        {{$home->items->skip(6)->first()->title}}
                                                    </h6>
                                                </div>
                                            </div>

                                        </a>
                                    @endif
                                </div>

                            </div>
                        @endif
                    </div>
                @elseif($home->type == "blog")
                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/Document.svg')  }}">
                                    <h2>
                                        {{ $home->title }}
                                    </h2>
                                </div>
                                <a class="submit-button button flex-box" href="{{route('blogs')}}">
                                    <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                    همه مطالب
                                </a>

                            </div>
                        </div>
                        <div class="nav-row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="blog-owl-carousel" class="blog-owl-carousel owl-carousel owl-theme">
                                @each('components.blog_square' , $home->items , 'blog')
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach

            <div class="row margin">
                <div class="space col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{ asset('client/assets/icon/Combined%20Shape.svg')  }}">
                            <h2>
                                {{ setting('home.good_link') }}
                            </h2>
                        </div>
                    </div>
                    <div class="white-box">
                        @foreach($links as $link)
                            <a class="flex-box link-item" href="{{ $link->link }}">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/attache.svg')  }}">
                                    {{ $link->title }}
                                </div>
                                <img src="{{ asset('client/assets/icon/black2arrow.svg')  }}">
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class=" space col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{ asset('client/assets/icon/Combined%20Shape.svg')  }}">
                            <h2>
                                {{ setting('home.service') }}
                            </h2>
                        </div>
                    </div>
                    <div id="white-box" class="web-item white-box">

                        <div class="tabs">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                    <ul id="tab-links">
                                        <li>
                                            <a href="#tab-1" class="flex-box active link-item">
                                                <div class="flex-box">
                                                    <img src="{{ asset('client/assets/icon/serial.svg')  }}">
                                                    ارتباط با کارشناس
                                                </div>
                                                <img class="arrow"
                                                     src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                                            </a>

                                        </li>
                                        <li>
                                            <a href="#tab-2" class="flex-box  link-item">
                                                <div class="flex-box">
                                                    <img src="{{ asset('client/assets/icon/achar.svg')  }}">
                                                    {{ setting('home.second_services_title') }}
                                                </div>
                                                <img class="arrow"
                                                     src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                                            </a>

                                        </li>
                                        <li>
                                            <a href="#tab-3" class="flex-box  link-item">
                                                <div class="flex-box">
                                                    <img src="{{ asset('client/assets/icon/squer.svg')  }}">
                                                    {{ setting('home.third_services_title') }}
                                                </div>
                                                <img class="arrow"
                                                     src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                                            </a>

                                        </li>
                                    </ul>

                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">

                                    <section id="tab-1" class="active">
                                        <p>
                                            ارتباط با کارشناس
                                        </p>

                                        <form id="main_form1" method="post" action="{{ route('main_form') }}">

                                            <div class="row" style="column-gap: 10px;">
                                                @csrf
                                                <!--                                                <div class="space col-lg-5 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="input-row">
                                                        <div class="custom-select">
                                                            <img src="{{ asset('client/assets/icon/angle-left.svg')}}">
                                                            <select name="brand">
                                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>


                                                @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>-->
                                                {{--                                                <div class="space col-lg-7 col-md-12 col-sm-6 col-xs-12">--}}

                                                <div class="row" style="column-gap: 10px;">
                                                    <div class="input-row" style="flex: 1">
                                                        <input class="serial" type="text"
                                                               placeholder="نام و نام خانوادگی"
                                                               name="name" required>
                                                        <img class="serial-icone" style="width:15px"
                                                             src="{{ asset('client/assets/icon/account.svg')  }}">
                                                    </div>
                                                    <div class="input-row" style="flex: 1">
                                                        <input class="serial" type="text" placeholder="شماره تلفن"
                                                               name="phone" required>
                                                        <img class="serial-icone"
                                                             src="{{ asset('client/assets/icon/serial-icone.svg')  }}">
                                                    </div>
                                                </div>
                                                <div class="row" style="column-gap: 10px;">

                                                    <div class="input-row" style="flex:1">
                                                        <input class="serial" type="text" placeholder="توضیحات"
                                                               name="description" required>
                                                    </div>
                                                </div>
                                                {{--                                                </div>--}}

                                            </div>
                                        </form>

                                        <div class="aline-left title-item flex-box">
                                            <p class="error">
                                                @error("code")
                                                {{ $message }}
                                                @enderror
                                            </p>
                                            <a class="submit-button button flex-box"
                                               onclick="(() => { document.getElementById('main_form1').submit(); })()">
                                                <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                                ارسال پیام
                                            </a>
                                        </div>
                                    </section>

                                    <section id="tab-2">
                                        <p>
                                            {{ setting('home.second_services_text') }}
                                        </p>
                                        <div class="aline-left ">
                                            <a class="submit-button button flex-box "
                                               href="{{ route('new_regulate') }}">
                                                <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                                درخواست کوک و رگلاژ
                                            </a>
                                        </div>
                                    </section>

                                    <section id="tab-3">
                                        <p>
                                            {{ setting('home.third_services_text') }}
                                        </p>
                                        <div class="aline-left ">
                                            <a class="submit-button button flex-box " href="{{ route('new_pickup') }}">
                                                <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                                درخواست باربری
                                            </a>
                                        </div>

                                    </section>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div id="white-box2" class="mobile-item white-box">
                        <div class="service-row">
                            <a class="flex-box active link-item">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/serial.svg')  }}">
                                    {{ setting('home.first_services_title') }}
                                </div>
                                <img class="arrow" src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                            </a>

                            <div class="service-content">

                                <p>
                                    {{ setting('home.first_services_text') }}
                                </p>

                                <form id="main_form1" method="post" action="{{ route('main_form') }}">

                                    <div class="row">
                                        @csrf
                                        <div class="space col-lg-5 col-md-12 col-sm-6 col-xs-12">
                                            <div class="input-row">
                                                <div class="custom-select">
                                                    <img src="{{ asset('client/assets/icon/angle-left.svg')}}">
                                                    <select name="brand">
                                                        @foreach($brands as $brand)
                                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="space col-lg-7 col-md-12 col-sm-6 col-xs-12">

                                            <div class="input-row">
                                                <input class="serial" type="text" placeholder="سریال کد "
                                                       name="code" required>
                                                <img class="serial-icone"
                                                     src="{{ asset('client/assets/icon/serial-icone.svg')  }}">
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <div class="aline-left title-item flex-box">
                                    <p class="error">
                                        @error("code")
                                        {{ $message }}
                                        @enderror
                                    </p>
                                    <a class="submit-button button flex-box request-button"
                                       onclick="(() => { document.getElementById('main_form1').submit(); })()">
                                        <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                        بررسی
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="service-row">
                            <a class="flex-box  link-item">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/achar.svg')  }}">
                                    {{ setting('home.second_services_title') }}
                                </div>
                                <img class="arrow" src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                            </a>

                            <div class="service-content">
                                <p>
                                    {{ setting('home.second_services_text') }}
                                </p>
                                <div class="aline-left">
                                    <a class="submit-button button flex-box request-button"
                                       href="{{ route('new_regulate') }}">
                                        <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                        درخواست کوک و رگلاژ
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="service-row">
                            <a class="flex-box active link-item">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/squer.svg')  }}">
                                    {{ setting('home.third_services_title') }}
                                </div>
                                <img class="arrow" src="{{ asset('client/assets/icon/black2arrow.svg')  }}">

                            </a>


                            <div class="service-content">
                                <p>
                                    {{ setting('home.third_services_text') }}
                                </p>
                                <div class="aline-left">
                                    <a class="submit-button button flex-box request-button"
                                       href="{{ route('new_pickup') }}">
                                        <img src="{{ asset('client/assets/icon/white-arrow.svg')  }}">
                                        درخواست باربری
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection

@section('optional_footer')

    <script>

        $('.service-row .link-item').click(function () {
            $(this).parent().toggleClass("active")
        });

    </script>
    <script>

        $(document).ready(function () {
            var playing = false;

            $('.main-play').click(function () {

                if (playing == false) {
                    document.getElementById('player').play();
                    playing = true;
                    $(".main-play .play").hide();
                    $(".main-play .pause").show();


                } else {
                    document.getElementById('player').pause();
                    playing = false;
                    $(".main-play .play").show();
                    $(".main-play .pause").hide();
                }
            });
        });

        $(document).ready(function () {
            var owl = $('#owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 10,
                dots: true,
                nav: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 2000,

            });

            // Custom Button
            $('.customNextBtn').click(function () {
                owl.trigger('next.owl.carousel');
            });
            $('.customPreviousBtn').click(function () {
                owl.trigger('prev.owl.carousel');
            });

        });

        $(document).ready(function () {
            var owl = $('.product-owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                nav: true,
                autoplay: false,
                rtl: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                    },
                    // breakpoint from 480 up
                    480: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 3,
                    },
                    968: {
                        items: 4,
                    },
                }
            });

        });
        $(document).ready(function () {
            var owl = $('.blog-owl-carousel');
            owl.owlCarousel({
                loop: false,
                margin: 0,
                dots: false,
                rtl: true,
                nav: true,
                autoplay: false,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                    },
                    // breakpoint from 480 up
                    480: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 3,
                    },
                    968: {
                        items: 4,
                    },
                }
            });

        });
        $(document).ready(function () {
            var owl = $('.book-owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                rtl: true,
                nav: true,
                autoplay: false,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                        center: true

                    },
                    // breakpoint from 480 up
                    480: {
                        items: 3,
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 4,
                    },
                    968: {
                        items: 6,
                    },
                }
            });

        });

        $(document).ready(function () {
            var owl = $('#brand-owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                nav: true,
                autoplay: true,
                rtl: true,
                center: true,
                autoplayTimeout: 4000,
                smartSpeed: 2000,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                        center: true
                    },
                    // breakpoint from 480 up
                    480: {
                        items: 1,
                        center: true
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 4,
                    },
                    968: {
                        items: 5,
                    },
                }
            });

        });

    </script>

@endsection

@section('meta_tags')

@endsection

