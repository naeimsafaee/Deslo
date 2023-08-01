@extends('client.index')

@section('optional_header')
    <link href="{{ asset('client/assets/css/js-slider.css') }}" rel="stylesheet">
@endsection

@section('modal')
    <div class="modal  bs-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-message">
                        <h2>
                            فیلتر محصولات
                        </h2>
                        <div id="mobile_filter" class="row">

                        </div>
                        <div class="tab-row">
                            <a>
                                مرتب‌سازی بر اساس:
                            </a>
                            <br>
                            <a class="tab-item {{request('sort') == '' || request('sort') == 'latest' ? 'active' : ''}}"
                               href="{{request()->fullUrlWithQuery(['sort' => 'latest'])}}">
                                جدیدترین
                            </a>
                            <a class="tab-item {{request('sort') == 'expensive' ? 'active' : ''}}"
                               href="{{request()->fullUrlWithQuery(['sort' => 'expensive'])}}">
                                گران‌ترین
                            </a>
                            <a class="tab-item {{request('sort') == 'cheap' ? 'active' : ''}}"
                               href="{{request()->fullUrlWithQuery(['sort' => 'cheap'])}}">
                                ارزان‌ترین
                            </a>
                            <a class="tab-item {{request('sort') == 'popular' ? 'active' : ''}}"
                               href="{{request()->fullUrlWithQuery(['sort' => 'popular'])}}">
                                محبوب‌ترین
                            </a>
                       {{--     <a class="tab-item {{request('sort') == 'books' ? 'active' : ''}}"
                               href="{{request()->fullUrlWithQuery(['sort' => 'books'])}}">
                                کتاب ها
                            </a>--}}
                            @if( !( Request()->has('search_in') && Request()->search_in === "books"))

                                {{--<a class="tab-item {{request('sort') == 'books' ? 'active' : ''}}"
                                   href="{{request()->fullUrlWithQuery(['sort' => 'books'])}}">
                                    کتاب ها
                                </a>--}}
                                <a class="tab-item {{request('sort') == 'used' ? 'active' : ''}}"
                                   href="{{request()->fullUrlWithQuery(['sort' => 'used'])}}">
                                    محصولات کار کرده
                                </a>
                            @endif



                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <a class="delete-filter flex-box" href="{{route('search', ['search_in' => request()->search_in])}}">
                                    حذف فیلتر ها
                                </a>
                            </div>
                            <div class="space col-lg-6 col-md-6 col-sm-6 col-12">
                                <a class="apply-filter-action submit-filter submit-button">
                                    <div class="icon-item">
                                        <img src="{{asset('client/assets/icon/filter.svg')}}">

                                    </div>
                                    اعمال فیلتر‌ها
                                </a>
                            </div>
                            <div class="space left-items col-lg-6 col-md-6 col-sm-6 col-12">
                                <a data-toggle="modal" data-target=".bs-example-modal-new" href="#"
                                   class="submit-filter submit-button">
                                    <div class="icon-item">
                                        <img src="{{asset('client/assets/icon/filter.svg')}}">

                                    </div>
                                    انصراف از فیلتر‌ها
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <button type="button" class="close-item" data-dismiss="modal"><img
                            src="{{asset('client/assets/icon/modalclose.svg')}}">
                </button>

            </div>
            <!-- Modal Content: ends -->

        </div>

    </div>
@endsection
@section('content')
    <div class="fade-page"></div>

    <div class="overlay">
    </div>

    <div class="col-lg-12">
        <div id="container" class="container">

            <div class="row">
                <div class="space col-lg-3 col-md-4 col-sm-12">
                    <div class="row">
                        <div id="desktop_filter" class="row">


                            <form id="filter-form" method="get" action="{{route('search')}}"
                                  class="col-lg-12 col-md-12 col-sm-12">
                                @csrf

                                <input type="hidden" name="search_in" value="{{Request()->search_in ?? ""}}">
                                @if(  Request()->has('search_in') && Request()->search_in === "books")

                                    {{--CATEGORY--}}
                                    @php
                                    @endphp
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="white-box">
                                            <div class="flex-box filter-title">
                                                <div class="dot flex-box">
                                                    <span></span>
                                                </div>
                                                <h2>
                                                    دسته بندی
                                                </h2>

                                            </div>
                                                @foreach($categories as $sub_category)
                                                    <div class="filter-item radio-wrapper">
                                                        <a style="color: inherit !important;"
                                                           href="{{route('search', ['category' => $sub_category->id , 'search_in' => 'books'])}}">
                                                            <input type="checkbox" id="{{'category-' . $sub_category->id}}"
                                                                   name="category[]"
                                                                   @if(request()->has('category') && request()->category == $sub_category->id) checked @endif value="{{ $sub_category->id}}">
                                                            <label for="{{'category-' . $sub_category->id }}">
                                                                {{ $sub_category->title }}
                                                            </label>
                                                        </a>
                                                    </div>
                                                @endforeach
                                        </div>
                                    </div>

                                @else

                                    {{--BRANDS--}}
                                    @if($brands->count() > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="white-box">
                                                <div class="flex-box filter-title">
                                                    <div class="dot flex-box">
                                                        <span></span>
                                                    </div>
                                                    <h2>
                                                        برند
                                                    </h2>

                                                </div>

                                                @each('components.brand_search' , $brands , 'brand')

                                            </div>
                                        </div>
                                    @endif

                                    {{--TYPES--}}
                                    @if($types->count() > 0)

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="white-box">
                                                <div class="flex-box filter-title">
                                                    <div class="dot flex-box">
                                                        <span></span>
                                                    </div>
                                                    <h2>
                                                        نوع
                                                    </h2>
                                                </div>

                                                @each('components.piano_type_search' , $types , 'type')

                                            </div>
                                        </div>

                                    @endif

                                    {{--SEARCH--}}
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="white-box">
                                            <div class="search-item flex-box">
                                                <input type="text" placeholder=" جستجو در بین نتایج" name="search"
                                                       value="{{request('search')}}">
                                                <img src="{{ asset('client/assets/icon/search.svg') }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--COLORS--}}
                                    @if($colors->count() > 0)
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="white-box">
                                                <div class="flex-box filter-title">
                                                    <div class="dot flex-box">
                                                        <span></span>
                                                    </div>
                                                    <h2>
                                                        رنگ
                                                    </h2>
                                                </div>
                                                <div class="color-row">
                                                    @each('components.color_search' , $colors , 'color')
                                                </div>
                                                <input type="hidden" name="colors">
                                            </div>
                                        </div>
                                    @endif

                                    {{--PRICE--}}
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="white-box">
                                            <div class="flex-box filter-title">
                                                <div class="dot flex-box">
                                                    <span></span>
                                                </div>
                                                <h2>
                                                    محدوده قیمت
                                                </h2>

                                            </div>

                                            <div>

                                                <div class="row range-slider" style="display: block;">


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif




                                {{--ISAVAILABLE--}}
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="white-box">
                                        <div class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                وضعیت محصول
                                            </h2>

                                        </div>
                                        <div class="filter-item radio-wrapper">
                                            <input type="radio" id="availability-on" name="availability" value="1" @if(request()->has('availability') && request()->availability == 1) checked @endif>
                                            <label for="availability-on">
                                                موجود
                                            </label>
                                        </div>
                                        <div class="filter-item radio-wrapper">
                                            <input type="radio" id="availability-off" name="availability" value="0" @if(request()->has('availability') && request()->availability  == 0) checked @endif>
                                            <label for="availability-off">
                                                همه
                                            </label>
                                        </div>

                                    </div>
                                </div>


                            </form>

                        </div>

                        <div class="web-filter col-lg-12 col-md-12 col-sm-12">
                            <button class="apply-filter-action submit-filter submit-button">
                                <div class="icon-item">
                                    <img src="{{ asset('client/assets/icon/filter.svg') }}">
                                </div>
                                اعمال فیلتر‌ها
                            </button>
                        </div>

                        <div class="web-filter col-lg-12 col-md-12 col-sm-12">
                            <a class="delete-filter flex-box" href="{{route('search', ['search_in' => request()->search_in])}}">
                                حذف فیلتر ها
                            </a>
                        </div>

                        <div class="mobile-filter col-lg-12 col-md-12 col-sm-12">
                            <a data-toggle="modal" data-target=".bs-example-modal-new" href="#"
                               class="submit-filter submit-button">
                                <div class="icon-item">
                                    <img src="{{ asset('client/assets/icon/filter.svg') }}">
                                </div>
                                فیلتر محصولات
                            </a>
                        </div>

                    </div>

                </div>

                <div class=" col-lg-9 col-md-8 col-sm-12">
                    <div class="row">

                        {{--SORT--}}
                        <div class="space web-filter col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box">
                                <div class="tab-row">
                                    <a>
                                        مرتب‌سازی بر اساس:
                                    </a>
                                    <a class="tab-item {{request('sort') == '' || request('sort') == 'latest' ? 'active' : ''}}"
                                       href="{{request()->fullUrlWithQuery(['sort' => 'latest'])}}">
                                        جدیدترین
                                    </a>
                                    <a class="tab-item {{request('sort') == 'expensive' ? 'active' : ''}}"
                                       href="{{request()->fullUrlWithQuery(['sort' => 'expensive'])}}">
                                        گران‌ترین
                                    </a>
                                    <a class="tab-item {{request('sort') == 'cheap' ? 'active' : ''}}"
                                       href="{{request()->fullUrlWithQuery(['sort' => 'cheap'])}}">
                                        ارزان‌ترین
                                    </a>
                                    <a class="tab-item {{request('sort') == 'popular' ? 'active' : ''}}"
                                       href="{{request()->fullUrlWithQuery(['sort' => 'popular'])}}">
                                        محبوب‌ترین
                                    </a>

                                    @if( !( Request()->has('search_in') && Request()->search_in === "books"))

                                        {{--<a class="tab-item {{request('sort') == 'books' ? 'active' : ''}}"
                                           href="{{request()->fullUrlWithQuery(['sort' => 'books'])}}">
                                            کتاب ها
                                        </a>--}}
                                        <a class="tab-item {{request('sort') == 'used' ? 'active' : ''}}"
                                           href="{{request()->fullUrlWithQuery(['sort' => 'used'])}}">
                                            محصولات کار کرده
                                        </a>
                                    @endif


                                </div>

                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">

                                @each('components.product' , $products , 'product')

                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            {{ $products->appends($_GET)->onEachSide(3)->links('components.page_numbers') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('optional_footer')
    <script src="{{asset('client/assets/js/rangeslider.js')}}"></script>

    <script>
        function changecolor() {
            $('.color-picker').on('click', function () {
                $(this).toggleClass('active');
                let colors = []
                $('.color-picker.active').each(function () {
                    colors.push($(this).data('color-id'));
                })
                $('input[name="colors"]').val(colors.join('-'))
            });
        }

        function changetag() {
            $('.tab-item').on('click', function () {
                $(".tab-item").removeClass('active');
                $(this).addClass('active');
            });
        }

        $(document).ready(function () {

            checkFilter()
            changecolor()
            changetag();
        });

        $(window).resize(function () {
            updateFilter()
        })


        function checkFilter() {
            let width = $(window).width();
            let mobileFilter = $('#mobile_filter')
            let desktopFilter = $('#desktop_filter')

            if (width <= 768) {
                mobileFilter.html(desktopFilter.html())
                desktopFilter.empty();
                changecolor()
                changetag();
                initSlider()


            } else {
                mobileFilter.empty();
                changecolor()
                changetag();
                initSlider()

            }

        }

        function updateFilter() {
            let width = $(window).width();
            let mobileFilter = $('#mobile_filter')
            let desktopFilter = $('#desktop_filter')
            if (width >= 768 && desktopFilter.html() === '') {
                desktopFilter.html(mobileFilter.html())
                mobileFilter.empty();
                changecolor()
                changetag();
                initSlider()

            } else if (width <= 768 && mobileFilter.html() === '') {
                mobileFilter.html(desktopFilter.html())
                desktopFilter.empty();
                changecolor()
                changetag();
                initSlider();

            }
        }

        function initSlider() {
            const e2p = s => s.replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d])
            Number.prototype.format = function (n, x) {
                var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
                return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
            };
            $(".range-slider").empty()
            $(".range-slider").append(`<input type="text" class="js-range-slider" name="price_range" value=""/>
                                   <div class="slider-labels">
                                       <span id="slider_max_lable" style="float: left"></span>
                                       <span id="slider_min_lable" style="float: right"></span>
                                   </div>`)

            $(".js-range-slider").ionRangeSlider({
                type: "double",
                min: 0,
                max: 300000000,
                skin: "round",
                step: 1000,
                hide_from_to: true,
                hide_min_max: true,
                onStart: updateSlider,
                onChange: updateSlider,
                onFinish: updateSlider
            });

            function updateSlider(data) {
                $('#slider_max_lable').text(e2p(data.from.format()) + ' تومان')
                $('#slider_min_lable').text(e2p(data.to.format()) + ' تومان')
            }
        }


        $('.apply-filter-action').click(function () {
            $('#filter-form').submit()
        })


    </script>

@endsection
