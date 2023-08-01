@extends('client.index')

@section('modal')
    <div class="modal  bs-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-message">
                        <h2>
                            فیلتر مقالات
                        </h2>
                        <div id="mobile_filter" class="row">

                        </div>



                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button id="submit-filter-mobile" class="apply-filter-action submit-filter submit-button">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/filter.svg') }}">
                                    </div>
                                    جستجو
                                </button>
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
                            بلاگ
                        </a>
                    </div>
                </div>

                <div class="space col-lg-3 col-md-4 col-sm-12">
                    <div id="desktop_filter" class="row">
                        <form id="filter-form" method="get" action="{{route('blogs')}}" style="width: 100%;">
                            @if($categories->count() > 0)
                                <div class="col-lg-12 col-md-12 col-sm-12" >
                                    <div class="white-box">
                                        <div class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                دسته‌بندی‌ها
                                            </h2>

                                        </div>

                                        @each('components.blog_category' , $categories , 'category')

                                    </div>
                                </div>
                            @endif


                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="white-box">
                                    <div class="search-item flex-box">
                                        <input type="text" placeholder=" جستجو در بین نتایج" name="search"
                                               value="{{request('search')}}">
                                        <img src="{{asset('client/assets/icon/search.svg')}}">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>



                    <div class="mobile-filter col-lg-12 col-md-12 col-sm-12">
                        <a data-toggle="modal" data-target=".bs-example-modal-new" href="#"
                           class="submit-filter submit-button">
                            <div class="icon-item">
                                <img src="{{ asset('client/assets/icon/filter.svg') }}">
                            </div>
                            فیلتر مقالات
                        </a>
                    </div>
                </div>

                <div class="space col-lg-9 col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                @each('components.blog' , $blogs, 'blog')
                            </div>
                        </div>
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            {{ $blogs->onEachSide(3)->links('components.page_numbers') }}

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('optional_footer')
    <script>

        $(document).ready(function () {

            checkFilter()
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
            } else {
                mobileFilter.empty();
            }

            $('input[type="checkbox"]').change(function () {
                $('#filter-form').submit();
            })

            $('#submit-filter-mobile').click(function () {
                $('#filter-form').submit();
            })

        }

        function updateFilter() {
            let width = $(window).width();
            let mobileFilter = $('#mobile_filter')
            let desktopFilter = $('#desktop_filter')
            if (width >= 768 && desktopFilter.html() === '') {
                desktopFilter.html(mobileFilter.html())
                mobileFilter.empty();
            } else if (width <= 768 && mobileFilter.html() === '') {
                mobileFilter.html(desktopFilter.html())
                desktopFilter.empty();
            }

            $('input[type="checkbox"]').change(function () {
                $('#filter-form').submit();
            })

            $('#submit-filter-mobile').click(function () {
                $('#filter-form').submit();
            })

        }

    </script>
@endsection
