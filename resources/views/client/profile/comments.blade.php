@extends('client.index')

@section('content')
    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container">

            <div class="row">
                @include('client.profile.profile_detail')

                <div class="space col-lg-9 max-height col-md-7 col-sm-12">
                    <div id="filter-title" class="flex-box filter-title">
                        <div class="dot flex-box">
                            <span></span>
                        </div>
                        <h2>
                            نظرات من
                        </h2>

                    </div>
                    @if( count($comments)>0 )
                        <table>
                            <thead>
                            <tr class="tr">
                                <th class="width"> نام محصول</th>
                                <th class="medium-item ">محتوا</th>
                                <th class="width">وضعیت</th>
                                <th class="width">زمان</th>
                                <th class="width">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr class="tr">
                                    <td class="width" data-column="نام محصول"> پیانو مدل ۳</td>
                                    <td class="medium-item " data-column="محتوا ">{{ substr($comment->text , 0 , 20) }}</td>
                                    <td class=" width" data-column="وضعیت ">@if($comment->is_active) تاییدشده @else تایید نشده @endif</td>
                                    <td class=" width" data-column="وضعیت ">{{ fa_number($comment->shamsi_date) }}</td>
                                    <td class="width green" data-column="عملیات">
                                        @php
                                            $product = \App\Models\Product::query()->find($comment->product_id) ;
                                        @endphp
                                        <a style="color: inherit" @if($product) href="{{ route('single_product' , $product->slug)}}" @endif>
                                            مشاهده
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="center-dive">
                            <div id="empty-error" class="circle-box  icon-item">
                                <img src="{{asset('client/assets/icon/cross.svg')}}">
                            </div>
                            <h6>
                                شما تاکنون نظری ثبت نکرده‌اید
                            </h6>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection