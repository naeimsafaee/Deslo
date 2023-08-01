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
                            مقایسه محصول
                        </a>
                    </div>
                </div>

                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            @if(count($products) == 0)
                                <h1 style="text-align: center; margin-top: 50px;">هنوز محصولی برای مقایسه انتخاب نکرده اید</h1>
                            @else
                                <div class="flex-box filter-title">
                                    <div class="dot flex-box">
                                        <span></span>
                                    </div>
                                    <h2>
                                        مقایسه محصول
                                    </h2>

                                </div>
                                <div class="Technical-Specifications white-box flex-box">
                                    <div style="white-space: nowrap;overflow-x: scroll;">

                                        <div class="border-left">
                                            <div id="comprasion-box" class="comprasion-box">
                                                <img src="{{ asset('client/assets/photo/piano.png') }}">
                                            </div>

                                            @foreach($attribute as $attr)
                                                <h5>
                                                    {{ $attr["attr_text"] }}
                                                </h5>
                                            @endforeach

                                        </div>

                                        @foreach($products as $product)

                                            <div class="border-left">
                                                <div class="comprasion-box">
                                                    <img onclick="(() => { window.location = '{{ route('delete_comparison' , $product->id) }}' })()"
                                                         class="trash" src="{{ asset('client/assets/icon/delet.svg')}}">
                                                    <img src="{{ Voyager::image($product->thumbnail('small', 'main_image'))}}">
                                                </div>
                                                @foreach($attribute as $attr)
                                                    <h5>
                                                        @php
                                                            $has_attr = false;
                                                        @endphp
                                                        @foreach($product->attributes as $p_attrs)
                                                            @if($p_attrs->attribute_id == $attr["attr_id"])
                                                                {{ $attr["value"] }}
                                                                @php
                                                                    $has_attr = true;
                                                                @endphp
                                                                @break
                                                            @endif
                                                        @endforeach
                                                        @if(!$has_attr)
                                                            ندارد
                                                        @endif
                                                    </h5>
                                                @endforeach

                                            </div>

                                        @endforeach

                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('optional_footer')
    <script>
        let sizes = []
        $('.border-left h5').each(function () {
            let index = $(this).index()
            let height = $(this).height()
            if (sizes[index]) {
                if (sizes[index] < height){
                    sizes[index] = height
                }
            }else {
                sizes.push(height)
            }
        })

        for (let i = 0 ; i < sizes.length ; i++ ){
            $('.border-left h5').each(function () {
                let index = $(this).index()
                if (index == i) {
                    $(this).height(sizes[i])
                }
            })
        }
    </script>
@endsection
