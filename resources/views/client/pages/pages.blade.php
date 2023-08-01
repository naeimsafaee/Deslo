@extends('client.index')

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container max-height">

            <div class="row">

                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box blog-item blog-single-item">
                                <h2>
                                    {{$page->title}}
                                </h2>

                                {!! $page->content !!}

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
