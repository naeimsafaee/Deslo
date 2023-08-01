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
                            پادکست ها
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

                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <div class="row scroll">
                            @each('components.music_category', $categories, 'category')
                        </div>
                    </div>

                </div>
            @endif

            @if(count($videos) > 0)
                <div class="row margin">
                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                                @if($category)
                                    <h2>
                                        پادکست ها دسته {{ $category->title }}
                                    </h2>
                                @else
                                    <h2>
                                        پادکست ها
                                    </h2>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                @each('components.podcast' , $videos , 'podcast')
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
                                @if($category)
                                    <h2>
                                        پادکست ها دسته {{ $category->title }}
                                    </h2>
                                @else
                                    <h2>
                                        پادکست ها
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
