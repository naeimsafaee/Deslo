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
                            فایل‌های من
                        </h2>

                    </div>

                    @if(count($client->files) >0)
                    <table>
                        <thead>
                        <tr class="tr">
                            <th class="big-item"> نام فایل</th>
                            <th class="width"> تاریخ خرید  </th>
                            <th class="width">قیمت فایل</th>
                            <th class="width">عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->files as $file)
                        <tr class="tr">
                            <td class="big-item" data-column=" نام فایل">{{ $file->file->title }}</td>
                            <td class="width " data-column=" تاریخ خرید">{{ $file->shamsi_date }}</td>
                            <td class=" width" data-column="قیمت فایل">  {{ number_format($file->price) }}  تومان</td>
                            <td class="width green"  data-column="عملیات">
                                @if($file->file_type == 1)
                                <a href="{{ route('video' ,$file->file->slug) }}">
                                    مشاهده
                                </a>
                                @else
                                    <a href="{{ route('podcast' ,$file->file->slug) }}">
                                        مشاهده
                                    </a>
                                @endif
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
                                    شما تاکنون فایلی خریداری نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection