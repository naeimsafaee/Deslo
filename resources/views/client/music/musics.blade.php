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
                        <a href="{{ route('home') }}">
                            صفحه اصلی
                        </a>

                        <a class="arrow">
                            >
                        </a>
                        <a class="green">
                            آهنگ
                        </a>
                    </div>
                </div>

            </div>
            @if($is_category)
            <div class="row margin">
                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                            <h2>
                                دسته بندی ها
                            </h2>
                        </div>
                       {{-- <a class="submit-button button flex-box ">
                            <img src="{{asset('client/assets/icon/white-arrow.svg')}}')}}">
                            مشاهده همه
                        </a>--}}

                    </div>

                </div>
                <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div class="row scroll">
                        @foreach($categories as $category)
                        <div class="emoji-row space col-lg-2 col-md-4 col-sm-4 col-xs-12">
                            <a class="white-box flex-box emoji-item" href="{{ route('all_music_category' , $category->id) }}">
                                <img src="{{ get_image($category->icon) }}">
                                <h2>
                                    {{ $category->title }}
                                </h2>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            @endif

            @if(count($musics) > 0)
            <div class="row margin">
                <div class="space col-lg-12 col-md-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                            @if(isset($music_category))
                                <h2>
                                 موزیک ها دسته {{ $music_category->title }}
                                </h2>
                            @else
                            <h2>
                                 موزیک ها
                            </h2>
                            @endif

                        </div>
                        {{--<a class="submit-button button flex-box " href="{{ route('music_archive') }}">
                            <img src="{{asset('client/assets/icon/white-arrow.svg')}}">
                            همه موزیک ها

                        </a>--}}
                    </div>
                </div>
                <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="row">
                            @each('components.music' , $musics , 'music')
                        </div>
                    </div>
                </div>

            </div>

            @else

                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                @if(isset($music_category))
                                    <h2>
                                        موزیک ها دسته {{ $music_category->title }}
                                    </h2>
                                @else
                                    <h2>
                                        موزیک ها
                                    </h2>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                <h3 style="text-align: center">
                                    چیزی پیدا نشد

                                </h3>
                            </div>
                        </div>
                    </div>

                </div>

            @endif

        </div>
    </div>
@endsection