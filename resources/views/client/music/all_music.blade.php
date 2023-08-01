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
                            آهنگ
                        </a>
                    </div>
                </div>

            </div>

            <div class="row margin">
                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                            <h2>
                                دسته بندی ها
                            </h2>
                        </div>

                    </div>
                </div>
                <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div class="row scroll">
                        @each('components.music_category', $categories, 'category')
                    </div>
                </div>

            </div>


            @if(count($albums ?? []) > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                @if($category == TRUE)
                                    <h2>
                                        تازه ترین آلبوم ها دسته {{ $category->title }}
                                    </h2>
                                @else
                                    <h2>
                                        تازه ترین آلبوم ها
                                    </h2>
                                @endif
                            </div>
                            <a href="{{ route('all_album') }}" class="submit-button button flex-box ">
                                <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                همه آلبوم ها
                            </a>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                @each('components.album' , $albums , 'album')
                            </div>
                            <div class="space col-lg-12 col-md-12 col-sm-12">

                                {{ $albums->onEachSide(3)->links('components.page_numbers') }}

                            </div>

                        </div>
                    </div>

                </div>
            @endif

            @if(count($musics ?? []) > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                @if($category == TRUE)
                                    <h2>
                                        تازه ترین موزیک ها دسته {{ $category->title }}
                                    </h2>
                                @else
                                    <h2>
                                        تازه ترین موزیک ها
                                    </h2>
                                @endif
                            </div>
                            <a href="{{ route('all_music') }}" class="submit-button button flex-box ">
                                <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                همه موزیک ها
                            </a>

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
            @endif

            @php
                $most_viewed_music = \App\Models\Music::query()->whereDoesntHave('music')->orderBy('view' , 'desc')->take(14)->get()
            @endphp

            @if($most_viewed_music->count() > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">

                                <h2>
                                    پربازدید ترین موزیک ها
                                </h2>
                            </div>
                            <a href="{{ route('all_music') }}" class="submit-button button flex-box ">
                                <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                همه موزیک ها
                            </a>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                @each('components.music' , $most_viewed_music , 'music')
                            </div>

                        </div>
                    </div>

                </div>
            @endif

            @if(count($videos ?? []) > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                <h2>
                                    تازه ترین موزیک ویدیو ها
                                </h2>
                            </div>
                            <a href="{{ route('all_video') }}" class="submit-button button flex-box ">
                                <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                همه موزیک ویدیوها
                            </a>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                @each('components.video' , $videos , 'video')
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            @if(count($podcasts ?? []) > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                <h2>
                                    تازه ترین پادکست ها
                                </h2>
                            </div>
                            <a href="{{ route('all_podcast') }}" class="submit-button button flex-box ">
                                <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                همه پادکست ها
                            </a>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box ">
                            <div class="row">
                                @each('components.podcast' , $podcasts , 'podcast')
                            </div>
                        </div>
                    </div>

                </div>


            @endif

        </div>
    </div>

@endsection
