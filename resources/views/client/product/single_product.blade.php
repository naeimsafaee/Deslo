@extends('client.index')

@section('modal')
    <div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="image-box">
                    <div id="video-player"></div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container max-height">

            @if($product->stock > 0)

                <div class="row">
                    <div class="space col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 12px;">
                        <div class="flex-box back-item">
                            <a href="{{route('home')}}">
                                صفحه اصلی
                            </a>
                            @if(count($product->categories) > 0)
                                <a class="arrow">
                                    >
                                </a>
                                <a href="{{route('search', ['category' => $product->categories->first()->id])}}">
                                    {{$product->categories->first()->title}}
                                </a>
                            @endif

                        </div>
                    </div>

                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="white-box" class="white-box blog-item ">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                            <div id="payment-row" class="payment-row"
                                                 style="justify-content: unset !important;">

                                                <div class="flex-box">
                                                    <input type="checkbox" id="btn"
                                                           onclick="add_to_bookmark()" {{$is_favorite ? 'checked' : ''}}>
                                                    <div class="share">
                                                        <input type="checkbox" id="toggle" class="share__toggle" hidden>
                                                        <label for="toggle" class="share__button">
                                                            <img src="{{ asset('client/assets/icon/share-alt.svg') }}"
                                                                 alt="">
                                                        </label>
                                                        <a href="{{'https://t.me/share/url?url=' . request()->fullUrl(). '&text=' . $product->name}}"
                                                           class="share__icon share__icon--facebook">
                                                            <img src="{{ asset('client/assets/icon/telegram.svg') }}"
                                                                 alt="">
                                                        </a>
                                                        <a href="{{'https://twitter.com/intent/tweet?url=' . request()->fullUrl(). '&text=' . $product->name}}"
                                                           class="share__icon share__icon--twitter">
                                                            <img src="{{ asset('client/assets/icon/twitter.svg') }}"
                                                                 alt="">
                                                        </a>
                                                        <a href="whatsapp://send?text={{$product->name . '   ' . request()->fullUrl()}}"
                                                           class="share__icon share__icon--linkedin">
                                                            <img src="{{ asset('client/assets/icon/whatsapp.svg') }}"
                                                                 alt="">
                                                        </a>
                                                    </div>

                                                </div>


                                                <div class="outer" data-src="eee">
                                                    <div id="big" class="owl-carousel owl-theme" style="width: 100%">

                                                        <div class="item"
                                                             data-src="{{ Voyager::image($product->main_image) }}">
                                                            <img src="{{ Voyager::image($product->main_image)}}"
                                                                 class="cloudzoom"
                                                                 data-cloudzoom="zoomImage : '{{ Voyager::image($product->main_image)}}',zoomPosition:13 , zoomWidth:250 , zoomHeight: 250">
                                                        </div>

                                                        @foreach($product->images as $image)
                                                            <div class="item ZoomImage "
                                                                 data-src="{{ Voyager::image($image->image) }}">
                                                                <img src="{{ Voyager::image($image->image) }}"
                                                                     class="cloudzoom"
                                                                     data-cloudzoom="zoomImage : '{{ Voyager::image($image->image)}}',zoomPosition:13 , zoomWidth:250 , zoomHeight: 250">
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div id="thumbs" class="owl-carousel owl-theme">
                                                        <div class="item"
                                                             data-src="{{ Voyager::image($product->main_image) }}">
                                                            <img src="{{ Voyager::image($product->thumbnail('small', 'main_image'))}}">
                                                        </div>
                                                        @foreach($product->images as $image)
                                                            <div class="item"
                                                                 data-src="{{ Voyager::image($image->image) }}">
                                                                <img src="{{ Voyager::image($image->thumbnail('small', 'image')) }}">
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                                            <div class="payment-row">
                                                <div>
                                                    <h2>
                                                        {{ $product->name }}
                                                    </h2>

                                                    <div class="flex-box rating">
                                                        <div class="row">
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <p class="date" style="font-weight:300 ">
                                                                    {{ $product->sub_title }}
                                                                </p>
                                                            </div>

                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="flex-box rating-comment">
                                                                    @include('components.stars' , ['rate' => $product->rate])
                                                                </div>
                                                            </div>

                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12"
                                                                 style="font-weight:300 ">

                                                                @foreach($top_attributes as $attribute)
                                                                    <div class="flex-box filter-title">
                                                                        <div class="dot flex-box">
                                                                            <span></span>
                                                                        </div>
                                                                        <p style="font-weight:300 ">
                                                                            {{ $attribute->parent . ' : ' . $attribute->text }}
                                                                        </p>

                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                                @if($product->guaranties->count() > 0)
                                                                    <div class="product input-row">
                                                                        <div class="custom-select" id="guaranties">
                                                                            <img src="{{ asset('client/assets/icon/angle-left.svg') }}">
                                                                            <select>
                                                                                <option value="0">گارانتی</option>
                                                                                @foreach($product->guaranties as $guaranties)
                                                                                    <option value="{{ $loop->index }}">{{ $guaranties->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if($product->colors->count() > 0)

                                                                    <div class="product input-row">
                                                                        <div class="select-box">
                                                                            <div class="options-container">
                                                                                @foreach($product->colors as $color)
                                                                                    <div class="option"
                                                                                         data-color-id="{{$color->id}}"
                                                                                         onclick='sendUrl({{$color->id}} , "{{ request()->has('order') ? request()->order : false }}")'>
                                                                                        <input type="radio"
                                                                                               class="radio"
                                                                                               name="category"/>
                                                                                        <label>
                                                                                            <div class="flex-box">
                                                                                                <div class="dot flex-box">
                                                                                                    <div style="background-color: {{ $color->code }}"></div>
                                                                                                </div>
                                                                                                {{ $color->title }}
                                                                                            </div>
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="product-feature selected"
                                                                                 style="color: var(--first-font-color) !important; font-weight: normal !important;">
                                                                                رنگ
                                                                                <img src="{{ asset('client/assets/icon/angle-left.svg') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="left-items space col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                                        <a id="m-button"
                                                           href="{{$is_comparing ? route('comparison') : route('add_comparison' , $product->id) }}"
                                                           class="submit-filter submit-button {{$is_comparing ? 'active' : ''}}">
                                                            <div class="icon-item">
                                                                <img src="{{asset('client/assets/icon/b-oluse.svg')}}">

                                                            </div>
                                                            @if($is_comparing)
                                                                مشاهده لیست مقایسه
                                                            @else
                                                                افزودن به لیست مقایسه
                                                            @endif
                                                        </a>

                                                    </div>

                                                    <div class="space col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                                        <h6>
                                                            وضعیت محصول:
                                                            <span class="green">موجود</span>
                                                        </h6>
                                                        <div class="flex-box add-order">
                                                            <div class="add-remove">
                                                                <p class="text-center grey">
                                                                    تعداد
                                                                </p>
                                                                <div class="flex-box">
                                                                    <div class="flex-box">
                                                                        <span class="add flex-box">+</span>
                                                                        <span class="counter">۱</span>
                                                                        <span class="remove flex-box">-</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                @if($product->is_discounted)
                                                                    <p class="grey">
                                                                        {{ fa_number(number_format($product->price)) }}
                                                                        تومان
                                                                    </p>
                                                                @endif
                                                                <h2 class="green">
                                                                    {{ fa_number(number_format($product->final_price)) }}
                                                                    تومان
                                                                </h2>
                                                            </div>

                                                        </div>
                                                        <form method="get"
                                                              action="{{ route('add_to_cart' , $product->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="count">
                                                            <button class="submit-filter submit-button">
                                                                <div class="icon-item">
                                                                    <img src="{{asset('client/assets/icon/online-shop.svg')}}">
                                                                </div>
                                                                افزودن به سبد خرید
                                                            </button>
                                                        </form>

                                                    </div>

                                                    @if($product->installment)
                                                        <div class="space col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="flex-box Installments ">
                                                                <img src="{{asset('client/assets/icon/wallet2.svg')}}">
                                                                <h6>
                                                                    با پرداخت ماهیانه
                                                                    {{fa_number(number_format($product->installmentMonthlyPay()))}}
                                                                    تومان این کالا را
                                                                    <a href="{{route('installment')}}"><span>اقساط</span></a>
                                                                    خریداری نمایید.
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        @if(count($product->comments)>0)
                            <div class="white-box blog-item ">
                                <div class="flex-box filter-title">
                                    <div class="dot flex-box">
                                        <span></span>
                                    </div>
                                    <h2>
                                        برخی نظرات کاربران درباره این محصول
                                    </h2>

                                </div>
                                <div class="row">
                                    @foreach($product->comments->take(4) as $comment)

                                        <div class="comment space col-lg-3 col-md-3 col-sm-4 col-12">
                                            <div class="flex-box rating">
                                                <div class="row">
                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>
                                                            {{ $comment->client->full_name ?? 'ناشناس' }}
                                                        </h5>
                                                    </div>
                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="flex-box rating-comment">

                                                            @include('components.stars' , ['rate' => $comment->rate])

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <h6>
                                                {{ $comment->text }}
                                            </h6>
                                        </div>

                                    @endforeach
                                </div>
                                @endif

                            </div>
                    </div>

                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="wrapper">
                            <div class="tabs2">

                                {{--TABS--}}
                                <div class="scroll tabs__header white-box">
                                    <div class="tabs__heading is-active" data-tab-index="tab-1">
                                        <span></span> نقد و بررسی تخصصی
                                    </div>
                                    <div class="tabs__heading" data-tab-index="tab-2" id="specifications_button">
                                        مشخصات فنی
                                        <span></span>
                                    </div>
                                    <div class="tabs__heading" data-tab-index="tab-3">نظرات کاربران
                                        <span></span></div>
                                    <div class="tabs__heading" data-tab-index="tab-4">پرسش و پاسخ
                                        <span></span></div>
                                    @if(count($product->samples) > 0)
                                        <div class="tabs__heading" data-tab-index="tab-5">
                                            <span></span>نمونه صدا
                                        </div>
                                    @endif
                                </div>

                                {{--FEATURE TAB--}}
                                <div class="tabs__body ">
                                    <div class="white-box tabs__content tab-1 is-active">
                                        <div class="row">

                                            @if(count($product->postive_features) > 0)
                                                {{--POSITIVE FEATURE--}}
                                                <div class="space Review-row col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <h5>
                                                        نقاط قوت
                                                    </h5>

                                                    @foreach($product->postive_features as $feature)
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <p>
                                                                {{ $feature->text }}
                                                            </p>

                                                        </div>
                                                    @endforeach

                                                </div>
                                            @endif


                                            @if(count($product->negative_features) > 0)
                                                {{--NEGATIVE FEATURE--}}
                                                <div class="space Review-row2 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <h5>
                                                        نقاط ضعف
                                                    </h5>
                                                    @foreach($product->negative_features as $feature)
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <p>
                                                                {{ $feature->text }}
                                                            </p>

                                                        </div>
                                                    @endforeach
                                                </div>

                                            @endif


                                            {{--DESCRIPTION--}}

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 20px;">
                                                <p>
                                                    {!! $product->short_description !!}
                                                </p>
                                                <div class="moretext">
                                                    {!! $product->description !!}
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            </div>
                                            <a class="moreless-button">
                                                <span>مشاهده ادامه</span>
                                                <img src="{{ asset('client/assets/icon/readmore.svg') }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="tabs__content tab-2 ">

                                    @foreach($attributes as $key => $value)

                                        <div class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                {{ $key }}
                                            </h2>

                                        </div>

                                        <div class="Technical-Specifications white-box flex-box">
                                            <div class="row">
                                                <div class="specifications border-left col-lg-3 col-md-3 col-sm-3 col-6">

                                                    @foreach($value as $attribute)
                                                        <h5 class="skeys" style="font-family: 'IranYekan';font-weight: unset !important; padding-right: 20px;">
                                                            {{ $attribute->parent }}
                                                        </h5>
                                                    @endforeach
                                                </div>
                                                <div class="specifications col-lg-9 col-md-9 col-sm-9 col-6">

                                                    @foreach($value as $attribute)
                                                        <h5 class="svals" style="font-weight: 400 !important;font-family: 'IranYekan';font-size: 14px">
                                                            {{ $attribute->text }}
                                                        </h5>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                        <br/>

                                    @endforeach

                                </div>

                                <div class="tabs__content tab-3">
                                    <div class="white-box">
                                        @if(auth()->guard('clients')->check())
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('comment_reply' , $product->id) }}">
                                                نظر خودتان در مورد این کالا را بنویسید
                                                <div>
                                                    <img src="{{asset('client/assets/icon/video.svg')}}">
                                                    <img src="{{asset('client/assets/icon/picture.svg')}}">
                                                </div>
                                            </a>
                                        @else
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('login') }}">
                                                برای ارسال دیدگاه ابتدا وارد حساب کاربری خود شوید
                                            </a>
                                        @endif
                                        <div class="margin flex-box">
                                            <h5 style="margin: 0">
                                                مرتب‌سازی نظرات بر اساس
                                            </h5>
                                            <div class="input-row">
                                                <div class="custom-select">
                                                    <img src="{{ asset('client/assets/icon/green-arrow.svg') }}">
                                                    <select id="selectcomment">
                                                        <option value="0">ترتیب</option>
                                                        <option value="newest"
                                                                @if(request()->order === 'جدید ترین') selected @endif>
                                                            جدید ترین
                                                        </option>
                                                        <option value="oldest"
                                                                @if(request()->order === 'قدیمی ترین') selected @endif>
                                                            قدیمی ترین
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        @foreach($comments as $comment)
                                            <div class="massage-row flex-box">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                        <div class="image-box">
                                                            <img src="{{ get_image($comment->client->image) }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                        <div class="massage-content">
                                                            <div class="flex-box rate">
                                                                <p class="massage-date">
                                                                    {{ fa_number($comment->shamsi_date) }}
                                                                </p>
                                                                <div class="flex-box rating-comment">
                                                                    @include('components.stars' , ['rate' => $comment->rate])

                                                                </div>
                                                            </div>

                                                            <h5>
                                                                {{ $comment->client->full_name ?? 'ناشناس' }}

                                                            </h5>
                                                            <p>
                                                                {{ $comment->text}}
                                                            </p>
                                                            @if(count($comment->files) > 0)
                                                                <div id="nazarat"
                                                                     class="image-row owl-carousel owl-theme">
                                                                    @foreach($comment->files as $file)
                                                                        <a class="item"
                                                                           href="{{ Voyager::image($file->file) }}"
                                                                           target="_blank">
                                                                            <div class="hover-box image-box">
                                                                                <img src="{{ strpos($file->file , "mp4") > -1 ? asset('client/assets/photo/mp4Icon.jpg') : Voyager::image($file->file) }}">
                                                                                <div class="content-onhover fadeIn-left">
                                                                                    <img src="{{asset('assets/icon/play.svg')}}">
                                                                                </div>
                                                                                <div class="content-overlay"></div>

                                                                            </div>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <div class="row">
                                                                @if(count($comment->positives) >0)
                                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="User-comments">
                                                                            <h6>
                                                                                + نقاط قوت

                                                                            </h6>
                                                                            @foreach($comment->positives as $positive)
                                                                                <div class="flex-box filter-title">
                                                                                    <div class="dot flex-box">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <p>
                                                                                        {{ $positive->text }}
                                                                                    </p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(count($comment->negatives) >0)
                                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="User-comment2">
                                                                            <h6>
                                                                                - نقاط ضعف
                                                                            </h6>
                                                                            @foreach($comment->negatives as $negative)
                                                                                <div class="flex-box filter-title">
                                                                                    <div class="dot flex-box">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <p>
                                                                                        {{ $negative->text }}
                                                                                    </p>

                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="line"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tabs__content tab-4">
                                    <div class="white-box">
                                        @if(auth()->guard('clients')->check())
                                            <form method="post" action="{{ route('question_submit') }}">
                                                <div class="write-comment input-row">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <textarea placeholder="سوال خود را بپرسید" name="text"
                                                              required></textarea>
                                                </div>
                                                <div class="aline-left">
                                                    <button id="submit-massege" class="submit-filter submit-button">
                                                        <div class="icon-item">
                                                            <img src="{{asset('client/assets/icon/filter.svg')}}">
                                                        </div>
                                                        ارسال سوال
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('login') }}">
                                                برای پرسش سوال ابتدا وارد حساب کاربری خود شوید
                                            </a>
                                        @endif
                                        {{--
                                                                                <div class="margin flex-box">
                                                                                    <h5 style="margin: 0">
                                                                                        مرتب‌سازی نظرات بر اساس
                                                                                    </h5>
                                                                                    <div class="input-row">
                                                                                        <div class="custom-select">
                                                                                            <img src="{{ asset('client/assets/icon/green-arrow.svg') }}">
                                                                                            <select>
                                                                                                <option value="0">جدیدترین نظرات</option>
                                                                                                <option value="1">نام برند 1</option>
                                                                                                <option value="2">نام برند 2</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                        --}}
                                        @foreach($product->questions as $question)
                                            <div class="massage-row flex-box">
                                                <div class="row">
                                                    @if($question->client)
                                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                            <div class="image-box">
                                                                <img src="{{ get_image($question->client->image) }}">
                                                            </div>

                                                        </div>
                                                    @endif
                                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                        <div class="massage-content">
                                                            <p class="massage-date">
                                                                {{ fa_number($question->shamsi_date) }}
                                                            </p>

                                                            <h5>
                                                                @if($question->client)
                                                                    {{ $question->client->full_name }}
                                                                @else
                                                                    {{'ادمین'}}
                                                                @endif
                                                            </h5>
                                                            <p>
                                                                {{$question->text}}
                                                            </p>
                                                            <div class="aline-left">
                                                                <a class="like like-massage flex-box"
                                                                   href="{{ route('like_submit' , $question->id) }}">
                                                                    <img src="{{asset('client/assets/icon/thumbs-up.svg')}}">
                                                                    {{ $question->likes }}
                                                                </a>
                                                                <a class="dislike like-massage flex-box"
                                                                   href="{{ route('dis_like_submit' , $question->id) }}">
                                                                    <img src="{{asset('client/assets/icon/thumbs-down.svg')}}">
                                                                    {{ $question->dis_likes }}
                                                                </a>


                                                            </div>
                                                            {{--
                                                            @if(isset($admin))

                                                                <form method="post"
                                                                      action="{{ route('question_reply', $question->id) }}">

                                                                    <div class="write-comment input-row">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $product->id }}"
                                                                               name="product_id">
                                                                        <textarea placeholder="پاسخ شما" name="text"
                                                                                  required></textarea>
                                                                    </div>
                                                                    <div class="aline-left">
                                                                        <button id="submit-massege"
                                                                                class="submit-filter submit-button">
                                                                            <div class="icon-item">
                                                                                <img src="{{asset('client/assets/icon/filter.svg')}}">

                                                                            </div>
                                                                            ارسال پاسخ
                                                                        </button>

                                                                    </div>
                                                                </form>
                                                            @endif
--}}
                                                            @if(count($question->reply()) > 0)
                                                                <p class="flex-box more-comment">

                                                                    نمایش پاسخ ها ({{ count($question->reply()) }} پاسخ)
                                                                    <img src="{{asset('client/assets/icon/readmore.svg')}}">
                                                                </p>
                                                                <div class="q-a-row">
                                                                    @foreach($question->reply() as $reply)
                                                                        <div class="massage-content question-item">
                                                                            <p class="massage-date">
                                                                                {{ fa_number($reply->shamsi_date) }}
                                                                            </p>

                                                                            <h5>
                                                                                @if($reply->client)
                                                                                    {{ $reply->client->full_name }}
                                                                                @else
                                                                                    {{'ادمین'}}
                                                                                @endif
                                                                            </h5>
                                                                            <p>
                                                                                {{ $reply->text }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                    {{--
                                                                                                                                <div class=" answer-item">
                                                                                                                                    <div class="row">
                                                                                                                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                                                                                                            <div class="image-box">
                                                                                                                                                <img src="client/assets/photo/man.png">
                                                                                                                                            </div>

                                                                                                                                        </div>
                                                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                                            <div class="massage-content">
                                                                                                                                                <p class="massage-date">
                                                                                                                                                    ۱۳ مهر ماه ۱۳۹۸
                                                                                                                                                </p>
                                                                                                                                                <h5>
                                                                                                                                                    ایمان انصاری فر
                                                                                                                                                </h5>
                                                                                                                                                <p>
                                                                                                                                                    محصول به‌شدت مقرون به صرفه‌ای است و خرید
                                                                                                                                                    ان
                                                                                                                                                    را به همگان توصیه می‌کنم.امیدوارم هر چه
                                                                                                                                                    زودتر دوباره موجود شود.
                                                                                                                                                </p>
                                                                                                                                            </div>

                                                                                                                                        </div>
                                                                                                                                    </div>

                                                                                                                                </div>
                                                                    --}}

                                                                </div>
                                                                <div class="line"></div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                @if(count($product->samples) > 0)
                                    <div class="tabs__content tab-5">
                                        <div class="white-box">

                                            @each('components.sample', $product->samples, 'sample')

                                        </div>

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="space col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div class="flex-box">
                                    <img src="{{ asset('client/assets/icon/Combined%20Shape.svg') }}">
                                    <h2>
                                        محصولات مرتبط

                                    </h2>
                                </div>
                            </div>
                        </div>


                        {{--RELATED--}}
                        <div class="nav-row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-owl-carousel owl-carousel owl-theme owl-loaded owl-drag"
                                 id="new-product-owl-carousel">
                                @each('components.small_product' , $related , 'product')
                            </div>
                        </div>


                    </div>


                </div>


            @else

                <div class="row margin">

                    <div class="space col-lg-12 col-md-12">
                        <div class="title-item flex-box">
                            <div class="flex-box">
                                <img src="{{asset('client/assets/icon/Combined%20Shape.svg')}}">
                                <h2>
                                    محصولات مرتبط

                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="nav-row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-owl-carousel owl-carousel owl-theme owl-loaded owl-drag"
                             id="new-product-owl-carousel">
                            @each('components.small_product' , $related , 'product')
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="white-box" class="white-box blog-item ">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                            <div id="payment-row" class="payment-row"
                                                 style="justify-content: unset !important;">
                                                <div class="flex-box">
                                                    <input type="checkbox" id="btn"
                                                           onclick="add_to_bookmark()" {{$is_favorite ? 'checked' : ''}}>
                                                    <div class="share">
                                                        <input type="checkbox" id="toggle" class="share__toggle" hidden>
                                                        <label for="toggle" class="share__button">
                                                            <img src="{{ asset('client/assets/icon/share-alt.svg') }}"
                                                                 alt="">
                                                        </label>
                                                        <a href="{{'https://t.me/share/url?url=' . request()->fullUrl(). '&text=' . $product->name}}"
                                                           class="share__icon share__icon--facebook">
                                                            <img src="{{ asset('client/assets/icon/telegram.svg') }}"
                                                                 alt="">
                                                        </a>
                                                        <a href="{{'https://twitter.com/intent/tweet?url=' . request()->fullUrl(). '&text=' . $product->name}}"
                                                           class="share__icon share__icon--twitter">
                                                            <img src="{{ asset('client/assets/icon/twitter.svg') }}"
                                                                 alt="">
                                                        </a>
                                                        <a href="whatsapp://send?text={{$product->name . '   ' . request()->fullUrl()}}"
                                                           class="share__icon share__icon--linkedin">
                                                            <img src="{{ asset('client/assets/icon/whatsapp.svg') }}"
                                                                 alt="">
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="outer">
                                                    <div id="big" class="owl-carousel owl-theme" style="width: 100%;">

                                                        <div class="item ZoomImage "
                                                             data-src="{{ Voyager::image($product->main_image)}}">
                                                            <img src="{{ Voyager::image($product->main_image)}}"
                                                                 class="cloudzoom"
                                                                 data-cloudzoom="zoomImage : '{{ Voyager::image($product->main_image)}}',zoomPosition:13 , zoomWidth:250 , zoomHeight: 250">
                                                        </div>

                                                        @foreach($product->images as $image)
                                                            <div class="item ZoomImage "
                                                                 data-src="{{ Voyager::image($image->image) }}">
                                                                <img src="{{ Voyager::image($image->image) }}"
                                                                     class="cloudzoom"
                                                                     data-cloudzoom="zoomImage : '{{ Voyager::image($image->image)}}',zoomPosition:13 , zoomWidth:250 , zoomHeight: 250">
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div id="thumbs" class="owl-carousel owl-theme">
                                                        <div class="item"
                                                             data-src="{{ Voyager::image($product->main_image)}}">
                                                            <img src="{{ Voyager::image($product->thumbnail('small', 'main_image'))}}">
                                                        </div>
                                                        @foreach($product->images as $image)
                                                            <div class="item"
                                                                 data-src="{{ Voyager::image($image->image) }}">
                                                                <img src="{{ Voyager::image($image->thumbnail('small', 'image')) }}">
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                                            <div class="payment-row">
                                                <div>
                                                    <h2>
                                                        {{ $product->name }}
                                                    </h2>

                                                    <div class="flex-box rating">
                                                        <div class="row">
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <p class="date">
                                                                    {{ $product->sub_title }}
                                                                </p>

                                                            </div>
                                                            <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="flex-box rating-comment">
                                                                    @include('components.stars' , ['rate' => $product->rate])
                                                                </div>
                                                            </div>

                                                            <div class="space col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                                                @foreach($top_attributes as $attribute)
                                                                    <div class="flex-box filter-title">
                                                                        <div class="dot flex-box">
                                                                            <span></span>
                                                                        </div>
                                                                        <p>
                                                                            {{ $attribute->parent . ' : ' . $attribute->text }}
                                                                        </p>

                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="space col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                                                <div class="empty">
                                                                    <div class="flex-box">
                                                                        <div class="line"></div>
                                                                        <h4>
                                                                            ناموجود
                                                                        </h4>
                                                                        <div class="line"></div>
                                                                    </div>
                                                                    <p>
                                                                        متاسفانه این کالا در حال حاضر موجود نیست.
                                                                        می‌توانید از طریق لیست بالای صفحه، از محصولات
                                                                        مشابه این کالا دیدن نمایید
                                                                        .<br>
                                                                        یا با شماره تلفن زیر تماس حاصل کنید.
                                                                        <br>
                                                                        <span style="display: flex;direction: ltr">{{ setting('home.call') }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="left-items space col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                        <a id="m-button"
                                                           href="{{ route('add_comparison' , $product->id) }}"
                                                           class="submit-filter submit-button">
                                                            <div class="icon-item"><img
                                                                        src="{{ asset('client/assets/icon/b-oluse.svg') }}">
                                                            </div>
                                                            افزودن به لیست مقایسه
                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        @if(count($product->comments)>0)
                            <div class="white-box blog-item ">

                                <div class="flex-box filter-title">
                                    <div class="dot flex-box">
                                        <span></span>
                                    </div>
                                    <h2>
                                        برخی نظرات کاربران درباره این محصول
                                    </h2>

                                </div>
                                <div class="row">
                                    @foreach($product->comments->take(4) as $comment)

                                        <div class="comment space col-lg-3 col-md-3 col-sm-4 col-12">
                                            <div class="flex-box rating">
                                                <div class="row">
                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>
                                                            {{ $comment->client->full_name ?? 'ناشناس' }}
                                                        </h5>
                                                    </div>
                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="flex-box rating-comment">

                                                            @include('components.stars' , ['rate' => $comment->rate])

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <h6>
                                                {{ $comment->text }}
                                            </h6>
                                        </div>

                                    @endforeach
                                </div>
                                @endif

                            </div>
                    </div>
                    <div class="space col-lg-12 col-md-12 col-sm-12">
                        <div class="wrapper">
                            <div class="tabs2">
                                <div class="scroll tabs__header white-box">
                                    <div class="tabs__heading is-active" data-tab-index="tab-1">

                                        <span></span> نقد و بررسی تخصصی
                                    </div>
                                    <div class="tabs__heading" data-tab-index="tab-2" id="specifications_button">
                                        مشخصات فنی
                                        <span></span>
                                    </div>
                                    <div class="tabs__heading" data-tab-index="tab-3">نظرات کاربران
                                        <span></span></div>
                                    <div class="tabs__heading" data-tab-index="tab-4">پرسش و پاسخ
                                        <span></span></div>
                                    @if(count($product->samples) > 0)
                                        <div class="tabs__heading" data-tab-index="tab-5">
                                            <span></span>نمونه صدا
                                        </div>
                                    @endif
                                </div>
                                <div class="tabs__body ">
                                    <div class="white-box tabs__content tab-1 is-active">
                                        <div class="row">

                                            @if(count($product->postive_features) > 0)
                                                <div class="space Review-row col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <h5>
                                                        نقاط قوت
                                                    </h5>
                                                    @foreach($product->postive_features as $feature)
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <p>
                                                                {{ $feature->text }}
                                                            </p>

                                                        </div>
                                                    @endforeach

                                                </div>
                                            @endif

                                            @if(count($product->negative_features) > 0)
                                                <div class="space Review-row2 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <h5>
                                                        نقاط ضعف
                                                    </h5>
                                                    @foreach($product->negative_features as $feature)
                                                        <div class="flex-box filter-title">
                                                            <div class="dot flex-box">
                                                                <span></span>
                                                            </div>
                                                            <p>
                                                                {{ $feature->text }}
                                                            </p>

                                                        </div>
                                                    @endforeach

                                                </div>
                                            @endif

                                            {{--DESCRIPTION--}}

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 20px;">
                                                <p>
                                                    {!! $product->short_description !!}
                                                </p>
                                                <div class="moretext">
                                                    {!! $product->description !!}
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            </div>
                                            <a class="moreless-button">
                                                مشاهده ادامه
                                                <img src="{{ asset('client/assets/icon/readmore.svg') }}">
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="tabs__content tab-2 ">
                                    @foreach($attributes as $key => $value)

                                        <div class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                {{ $key }}
                                            </h2>

                                        </div>

                                        <div class="Technical-Specifications white-box flex-box">
                                            <div class="row">
                                                <div class="specifications border-left col-lg-3 col-md-3 col-sm-3 col-6">

                                                    @foreach($value as $attribute)
                                                        <h5 class="skeys" style="font-weight: unset !important;font-family: 'IranYekan'; padding-right: 20px;">
                                                            {{ $attribute->parent }}
                                                        </h5>
                                                    @endforeach
                                                </div>
                                                <div class="specifications col-lg-9 col-md-9 col-sm-9 col-6">

                                                    @foreach($value as $attribute)
                                                        <h5 class="svals" style="font-weight: 400 !important;font-family: 'IranYekan';font-size: 14px">
                                                            {{ $attribute->text }}
                                                        </h5>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                        <br/>

                                    @endforeach
                                </div>
                                <div class="tabs__content tab-3">
                                    <div class="white-box">
                                        @if(auth()->guard('clients')->check())
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('comment_reply' , $product->id) }}">
                                                نظر خودتان در مورد این کالا را بنویسید
                                                <div>
                                                    <img src="{{asset('client/assets/icon/video.svg')}}">
                                                    <img src="{{asset('client/assets/icon/picture.svg')}}">
                                                </div>
                                            </a>
                                        @else
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('login') }}">
                                                برای ارسال دیدگاه ابتدا وارد حساب کاربری خود شوید
                                            </a>
                                        @endif
                                        <div class="margin flex-box">
                                            <h5 style="margin: 0">
                                                مرتب‌سازی نظرات بر اساس
                                            </h5>
                                            <div class="input-row">
                                                <div class="custom-select">
                                                    <img src="{{ asset('client/assets/icon/green-arrow.svg') }}">
                                                    <select id="selectcomment">
                                                        <option value="0">ترتیب</option>
                                                        <option value="newest"
                                                                @if(request()->order === 'جدید ترین') selected @endif>
                                                            جدید ترین
                                                        </option>
                                                        <option value="oldest"
                                                                @if(request()->order === 'قدیمی ترین') selected @endif>
                                                            قدیمی ترین
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        @foreach($comments as $comment)
                                            <div class="massage-row flex-box">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                        <div class="image-box">
                                                            <img src="{{ get_image($comment->client->image) }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                        <div class="massage-content">
                                                            <div class="flex-box rate">
                                                                <p class="massage-date">
                                                                    {{ fa_number($comment->shamsi_date) }}
                                                                </p>
                                                                <div class="flex-box rating-comment">
                                                                    @include('components.stars' , ['rate' => $comment->rate])
                                                                </div>
                                                            </div>

                                                            <h5>
                                                                {{ $comment->client->full_name ?? 'ناشناس' }}

                                                            </h5>
                                                            <p>
                                                                {{ $comment->text}}
                                                            </p>
                                                            @if(count($comment->files)>0)
                                                                <div id="nazarat"
                                                                     class="image-row owl-carousel owl-theme">
                                                                    @foreach($comment->files as $file)
                                                                        <a class="item"
                                                                           href="{{ Voyager::image($file->file) }}"
                                                                           target="_blank">
                                                                            <div class="hover-box image-box">
                                                                                <img src="{{ strpos($file->file , "mp4") > -1 ? asset('client/assets/photo/mp4Icon.jpg') : Voyager::image($file->file) }}">
                                                                                <div class="content-onhover fadeIn-left">
                                                                                    <img src="{{asset('assets/icon/play.svg')}}">
                                                                                </div>
                                                                                <div class="content-overlay"></div>

                                                                            </div>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <div class="row">
                                                                @if(count($comment->positives) >0)
                                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="User-comments">
                                                                            <h6>
                                                                                + نقاط قوت

                                                                            </h6>
                                                                            @foreach($comment->positives as $positive)
                                                                                <div class="flex-box filter-title">
                                                                                    <div class="dot flex-box">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <p>
                                                                                        {{ $positive->text }}
                                                                                    </p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(count($comment->negatives) >0)
                                                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="User-comment2">
                                                                            <h6>
                                                                                - نقاط ضعف
                                                                            </h6>
                                                                            @foreach($comment->negatives as $negative)
                                                                                <div class="flex-box filter-title">
                                                                                    <div class="dot flex-box">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <p>
                                                                                        {{ $negative->text }}
                                                                                    </p>

                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="line"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tabs__content tab-4">
                                    <div class="white-box">
                                        @if(auth()->guard('clients')->check())

                                            <form method="post" action="{{ route('question_submit') }}">

                                                <div class="write-comment input-row">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <textarea placeholder="سوال خود را بپرسید" name="text"
                                                              required></textarea>
                                                </div>
                                                <div class="aline-left">

                                                    <button class="submit-filter submit-button">
                                                        <div class="icon-item">
                                                            <img src="{{asset('client/assets/icon/filter.svg')}}">

                                                        </div>
                                                        ارسال سوال
                                                    </button>

                                                </div>
                                            </form>

                                        @else
                                            <a id="write-comment" class="write-comment input-row"
                                               href="{{ route('login') }}">
                                                برای پرسش سوال ابتدا وارد حساب کاربری خود شوید
                                            </a>
                                        @endif
                                        {{--todo
                                                                                <div class="margin flex-box">
                                                                                    <h5 style="margin: 0">
                                                                                        مرتب‌سازی نظرات بر اساس
                                                                                    </h5>
                                                                                    <div class="input-row">
                                                                                        <div class="custom-select">
                                                                                            <img src="{{ asset('client/assets/icon/green-arrow.svg') }}">
                                                                                            <select>
                                                                                                <option value="0">جدیدترین نظرات</option>
                                                                                                <option value="1">نام برند 1</option>
                                                                                                <option value="2">نام برند 2</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                        --}}
                                        @foreach($product->questions as $question)
                                            <div class="massage-row flex-box">
                                                <div class="row">
                                                    @if($question->client)
                                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                            <div class="image-box">
                                                                <img src="{{ get_image($question->client->image) }}">
                                                            </div>

                                                        </div>
                                                    @endif
                                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                        <div class="massage-content">
                                                            <p class="massage-date">
                                                                {{ fa_number($question->shamsi_date) }}
                                                            </p>

                                                            <h5>
                                                                @if($question->client)
                                                                    {{ $question->client->full_name }}
                                                                @else
                                                                    {{'ادمین'}}
                                                                @endif
                                                            </h5>
                                                            <p>
                                                                {{$question->text}}
                                                            </p>
                                                            <div class="aline-left">
                                                                <a class="like like-massage flex-box"
                                                                   href="{{ route('like_submit' , $question->id) }}">
                                                                    <img src="{{asset('client/assets/icon/thumbs-up.svg')}}">
                                                                    {{ $question->likes }}
                                                                </a>
                                                                <a class="dislike like-massage flex-box"
                                                                   href="{{ route('dis_like_submit' , $question->id) }}">
                                                                    <img src="{{asset('client/assets/icon/thumbs-down.svg')}}">
                                                                    {{ $question->dis_likes }}
                                                                </a>
                                                            </div>
                                                            @if(count($question->reply()) > 0)
                                                                <p class="flex-box more-comment">

                                                                    نمایش پاسخ ها ({{ count($question->reply()) }} پاسخ)
                                                                    <img src="{{asset('client/assets/icon/readmore.svg')}}">
                                                                </p>
                                                                <div class="q-a-row">
                                                                    @foreach($question->reply() as $reply)
                                                                        <div class="massage-content question-item">
                                                                            <p class="massage-date">
                                                                                {{ fa_number($reply->shamsi_date) }}
                                                                            </p>

                                                                            <h5>
                                                                                @if($reply->client)
                                                                                    {{ $reply->client->full_name }}
                                                                                @else
                                                                                    {{'ادمین'}}
                                                                                @endif
                                                                            </h5>
                                                                            <p>
                                                                                {{ $reply->text }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <div class="line"></div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                @if(count($product->samples) > 0)
                                    <div class="tabs__content tab-5">
                                        <div class="white-box">

                                            @each('components.sample', $product->samples, 'sample')

                                        </div>

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>

            @endif


        </div>


    </div>
    </div>
    <div class="Gallery"></div>
@endsection

@section('optional_footer')

    <script>

        let player;
        let progress;
        let currentTime;
        $(".play-pause-btn").click(function () {
            const id = $(this).attr('data-id')

            player = $("#sample" + id)[0];

            if (player.paused) {
                $(this).find("svg path").attr('d', "M0 0h6v24H0zM12 0h6v24h-6z");
                player.play();
            } else {
                $(this).find("svg path").attr('d', "M18 12L0 24V0");
                player.pause();
            }

            progress = document.getElementById("progress" + id)
            currentTime = document.getElementById("current_time" + id)

            document.getElementById("sample" + id).addEventListener('timeupdate', updateProgress);


        })

        function updateProgress() {
            var current = player.currentTime;
            var percent = current / player.duration * 100;
            progress.style.width = percent + '%';

            currentTime.textContent = formatTime(current);
        }

        function formatTime(time) {
            var min = Math.floor(time / 60);
            var sec = Math.floor(time % 60);
            return min + ':' + (sec < 10 ? '0' + sec : sec);
        }

        $(document).ready(function () {
            var owl = $('#nazarat');
            owl.owlCarousel({
                loop: false,
                margin: 10,
                dots: false,
                nav: false,
                autoplay: false,
                autoWidth: true,
                rtl: true,

            });

        });
    </script>
    <script>
        var player = new Playerjs(
            {
                id: "video-player",
                file: "https://assets.mixkit.co/videos/preview/mixkit-flying-through-the-clouds-with-the-radiant-sun-14171-large.mp4",
                poster: 'url("assets/photo/Group 16540.jpg")'
            }
        );
    </script>


    {{--    <script src="{{ asset('client/assets/js/audio-player.js') }}"></script>--}}


    <script>
        $(document).ready(function () {
            var owl = $('#newest-product-owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                nav: true,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 2000,
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
    </script>

    <script>
        $('.moreless-button').click(function () {

            $('.moretext').slideToggle();
            $(".moreless-button").toggleClass("active")

            if ($('.moreless-button').hasClass('active')) {
                $('.moreless-button span').text('بستن')
            } else {
                $('.moreless-button span').text('مشاهده ادامه')
            }
        });
        $('.more-comment').click(function () {
            $('.q-a-row').slideToggle();
            $('.more-comment').toggleClass("active")
        });

    </script>
    <script>
        $(document).ready(function () {
            var bigimage = $("#big");
            var thumbs = $("#thumbs");
            //var totalslides = 10;
            var syncedSecondary = true;

            bigimage
                .owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    dots: false,
                    loop: true,
                    autoplay: true,
                    autoplayHoverPause: true,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<i class=" " aria-hidden="true"><img src="{{ asset('client/assets/icon/right-arrow.svg') }}"></i>',
                        '<i class=" " aria-hidden="true"><img src="{{ asset('client/assets/icon/left-arrow.svg') }}"></i>'
                    ]
                })
                .on("changed.owl.carousel", syncPosition);

            thumbs
                .on("initialized.owl.carousel", function () {
                    thumbs
                        .find(".owl-item")
                        .eq(0)
                        .addClass("current");
                })
                .owlCarousel({
                    items: 4,
                    dots: false,
                    nav: false,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    autoWidth: true,
                    slideBy: 4,
                    responsiveRefreshRate: 100
                })
                .on("changed.owl.carousel", syncPosition2);

            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;

                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();
                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }

            thumbs.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                bigimage.data("owl.carousel").to(number, 300, true);
            });

            $(".cloudzoom").hover(function () {
                $(".cloudzoom-blank > div").last().remove();
                // bigimage.trigger('stop.owl.autoplay')
            })

            $(".cloudzoom-tint , .cloudzoom-lens , .cloudzoom")
                .mouseenter(function () {
                    bigimage.trigger('stop.owl.autoplay')
                })
            // .mouseleave(function() {
            //     bigimage.trigger('play.owl.autoplay')
            // });
        });


        $(document).ready(() => {
            $('.select-items div').click(function () {

                sendUrl('{{ request()->has('color') ? request()->color : false }}' , $(this).text().trim())
            })
        })

        function sendUrl(colorId , orderId){
            let url = new URL("{{ request()->url() }}");

            if(colorId != false)
                url.searchParams.set('color', colorId);

            if(orderId != false)
                url.searchParams.set('order', orderId);


            window.location = url.toString();
        }

    </script>
    <script>
        "use strict";

        document.querySelectorAll(".tabs2").forEach((tab) => {
            // Selecting headings and blocks with content
            const tabHeading = tab.querySelectorAll(".tabs__heading");
            const tabContent = tab.querySelectorAll(".tabs__content");

            // A variable for the data attribute
            let tabName;

            // For each tab heading...
            tabHeading.forEach((element) => {
                // ...add event listener
                element.addEventListener("click", () => {
                    // Disabling each tab
                    tabHeading.forEach((item) => {
                        item.classList.remove("is-active");
                    });

                    // Enabling a tab
                    element.classList.add("is-active");

                    // Getting value from the data attribute
                    tabName = element.getAttribute("data-tab-index");

                    // Checking all the blocks with content
                    tabContent.forEach((item) => {
                        // If the item has the same class as the value of the data attribute...
                        item.classList.contains(tabName)
                            ? item.classList.add("is-active")
                            : item.classList.remove("is-active");

                        // Add class 'is-active' to this item
                        // Otherwise, remove the class
                    });
                });
            });
        });

    </script>
    <script>
        jQuery(document).ready(function ($) {
            'use strict';

            const selected = $(".selected");
            const optionsContainer = $(".options-container");
            const optionsList = $(".option");

            selected.on('click', function () {
                optionsContainer.toggleClass("active");
            });


            @if(request()->has('color'))

                const colorId = '{{request()->color}}'

                const colorItem = $(`.option[data-color-id='${colorId}']`)

                selected.html(colorItem.find("label").html());
                optionsContainer.removeClass("active");
            @endif

            @if(request()->has('order'))

                const orderId = '{{request()->order}}'

                const orderItem = $('#guaranties .select-selected').text(orderId.replaceAll("+" , ""))

                // selected.html(colorItem.find("label").html());
                // optionsContainer.removeClass("active");
            @endif

            optionsList.each(function () {
                $(this).on('click', function () {
                    selected.html($(this).find("label").html());
                    optionsContainer.removeClass("active");
                });
            });

            $('body').on('click', function (event) {
                if (!$(event.target).hasClass('product-feature') && !$(event.target).hasClass('flex-box')) {
                    optionsContainer.removeClass("active");
                }
            });


        });
    </script>

    <script>

        function add_to_bookmark() {

            $.ajax({
                method: 'GET',
                url: "{{ route('toggle_bookmark' , $product->id) }}"
            });

        }


        $('#specifications_button').click(function () {
            setSizes()
        })

        function setSizes() {

            let sizes = []
            let h5 = $('.skeys');
            let h4 = $('.svals');

            for (let x = 0; x < h5.length; x++)
            {
                let el = h5.get(x);
                var rect = el.getBoundingClientRect();
                let height =  rect.height
                if (sizes[x]) {
                    if (sizes[x] < height) {
                        sizes[x] = height
                    }
                } else {
                    sizes.push(height)
                }

            }
            for (let y = 0; y < h4.length; y++)
            {
                let el = h4.get(y);
                var rect = el.getBoundingClientRect();
                let height =  rect.height


                if (sizes[y]) {
                    if (sizes[y] < height) {
                        sizes[y] = height
                    }
                } else {
                    sizes.push(height)
                }
            }


            for (let x = 0; x < h5.length; x++)
            {
                let el = h5.get(x);
                el.style.height = sizes[x] + 'px'
            }
            for (let y = 0; y < h4.length; y++)
            {
                let el = h4.get(y);
                el.style.height = sizes[y] + 'px'
            }
        }

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
                nav: false,
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
                rtl: true,
                dots: false,
                nav: false,
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
            var owl = $('.blog-owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                rtl: true,
                nav: false,
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
                nav: false,
                rtl: true,
                autoplay: false,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 2,
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
    </script>

    <script>
        $(document).ready(function () {

            setTimeout(() => {
                CloudZoom.quickStart();
            }, 2000);

            // $(".cloudzoom").hover(function(){
            //     $(".cloudzoom-blank > div").last().remove();
            //     bigimage.trigger('stop.owl.autoplay')
            // })
        })

        const el = document.getElementById('thumbs');
        const instance = lightGallery(el, {plugins: [lgZoom, lgFullscreen]});

        const el1 = document.getElementById('big');
        const instance1 = lightGallery(el1, {plugins: [lgZoom, lgFullscreen]});
        // instance.openGallery(1)

        let item = `[@foreach($product->images as $image) "{{ Voyager::image($image->thumbnail('small', 'image')) }}"@if(!$loop->last) , @endif @endforeach]`;
    </script>

@endsection

@section('meta_tags')

    <meta name="product_id" content="{{$product->id}}">

    <meta name="product_name" content="{{ $product->name}}">

    <meta property="og:image" content="{{ Voyager::image($product->main_image)}}">

    <meta name="product_price" content="{{$product->final_price}}">

    <meta name="product_old_price" content="{{$product->price}}">

    <meta name="availability" content="{{$product->stock > 0 ? 'instock' : 'outofstock'}}">

    <meta name="keywords" content="{{$product->keywords}}">

    <meta name="description" content="{{$product->meta_description}}">
@endsection
