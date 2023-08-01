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

            </div>
            <div class="row margin">
                <div class="space col-lg-12 col-md-12">
                    <div class="title-item flex-box">
                        <div class="flex-box">
                            <img src="{{asset('client/assets/icon/Ticket%20Star.svg')}}">
                            <h2>
                                نمایش لیست {{ $artist->full_name }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-sc-1 col-md-3 col-sm-4 col-6">
                                <div class="album-archive">
                                    <a class=" image-box">
                                        <img src="{{ get_image($product->image) }}">
                                    </a>
                                    <h6>
                                        {{ $product->title }}
                                    </h6>
                                  {{--  <p>
                                        نام آرتیست
                                    </p>--}}
                                </div>

                            </div>
                            @endforeach
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div class="pagination flex-box">
                                <a class="flex-box active">
                                    ۱
                                </a>
                                <a class="flex-box">
                                    ۲
                                </a>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection