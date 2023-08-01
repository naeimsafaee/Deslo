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
                        <a href="{{route('blogs')}}">
                            بلاگ
                        </a>
                        <a class="arrow">
                            >
                        </a>
                        <a class="green">
                            {{$blog->title}}
                        </a>
                    </div>
                </div>

                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box blog-item blog-single-item">
                                <div class="image-box">
                                    <img src="{{ get_image($blog->image) }}">
                                </div>
                                <h2>
                                    {{ $blog->title }}
                                </h2>
                                <p>
                                    {!! $blog->description !!}
                                </p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
