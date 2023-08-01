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
                            آلبوم‌های من
                        </h2>

                    </div>

                    @if(count($client->albums )>0)
                        <table>
                            <thead>
                            <tr class="tr">
                                <th class="big-item"> نام آلبوم</th>
                                <th class="width"> تاریخ خرید</th>
                                <th class="width">قیمت آلبوم</th>
                                <th class="width">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($client->albums as $album)
                                <tr class="tr">
                                    <td class="big-item" data-column=" نام آلبوم ">{{ $album->album->title }}</td>
                                    <td class="width " data-column=" تاریخ خرید">{{ $album->shamsi_date }}</td>
                                    <td class=" width" data-column="قیمت آلبوم">  {{number_format($album->price)}}
                                        تومان
                                    </td>
                                    <td class="width green" data-column="عملیات">
                                        <a href="{{ route('album' , $album->album->slug) }}">
                                            مشاهده

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="center-dive">
                                <div id="empty-error" class="circle-box  icon-item">
                                    <img src="{{asset('client/assets/icon/cross.svg')}}">
                                </div>
                                <h6>
                                    شما تاکنون آلبومی خریداری نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection