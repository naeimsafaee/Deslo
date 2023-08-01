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
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="title-item flex-box">
                                <div id="filter-title" class="flex-box filter-title">
                                    <div class="dot flex-box">
                                        <span></span>
                                    </div>
                                    <h2>
                                        درخواست‌های کوک و رگلاژ
                                    </h2>

                                </div>

                                <a class="submit-button button flex-box" href="{{ route('new_regulate') }}">
                                    <img class="white-pluse" src="{{asset('client/assets/icon/white-pluse.svg')}}">
                                    درخواست جدید
                                </a>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="table1">
                                <thead>
                                <tr class="tr">
                                    <th class="width2">شماره </th>
                                    <th class="width2">شهر   </th>
                                    <th class="width2">آدرس </th>
                                    <th class="width"> شماره سریال</th>
                                    <th class="width2">مدل پیانو </th>
                                    <th class="width2">وضعیت  </th>
                                    <th class="width2">زمان  </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="tr">
                                    <td class="width2" data-column="شماره ">۲ </td>
                                    <td class="width2 " data-column="شهر ">تهران </td>
                                    <td class="width2 " data-column="آدرس ">۱۶میدان انقلاب..</td>
                                    <td class=" width" data-column="  شماره سریال "> ۱۲۳۱۲۳۲۲۲۳۱۲۳۱۲۳ </td>
                                    <td class=" width2" data-column="مدل پیانو ">۱۲۳۲۱۲۲</td>
                                    <td class="width2 "  data-column="وضعیت ">تاییدشده</td>
                                    <td class="width2 "  data-column="زمان  ">۲۰۲۰/۲/۱۸ </td>
                                </tr>
                                <tr class="tr">
                                    <td class="width2" data-column="شماره ">۲ </td>
                                    <td class="width2 " data-column="شهر ">تهران </td>
                                    <td class="width2 " data-column="آدرس ">۱۶میدان انقلاب..</td>
                                    <td class=" width" data-column="  شماره سریال "> ۱۲۳۱۲۳۲۲۲۳۱۲۳۱۲۳ </td>
                                    <td class=" width2" data-column="مدل پیانو ">۱۲۳۲۱۲۲</td>
                                    <td class="width2 "  data-column="وضعیت ">تاییدشده</td>
                                    <td class="width2 "  data-column="زمان  ">۲۰۲۰/۲/۱۸ </td>
                                </tr>
                                <tr class="tr">
                                    <td class="width2" data-column="شماره ">۲ </td>
                                    <td class="width2 " data-column="شهر ">تهران </td>
                                    <td class="width2 " data-column="آدرس ">۱۶میدان انقلاب..</td>
                                    <td class=" width" data-column="  شماره سریال "> ۱۲۳۱۲۳۲۲۲۳۱۲۳۱۲۳ </td>
                                    <td class=" width2" data-column="مدل پیانو ">۱۲۳۲۱۲۲</td>
                                    <td class="width2 red"  data-column="وضعیت ">رد شده</td>
                                    <td class="width2 "  data-column="زمان  ">۲۰۲۰/۲/۱۸ </td>
                                </tr>


                                </tbody>
                            </table>

                        </div>

                        {{--@if(count($client->regulate) >0)
                            <div class="col-lg-12 col-md-12">
                                <table class="table1">
                                    <thead>
                                    <tr class="tr">
                                        <th class="width2">شماره</th>
                                        <th class="width2">شهر</th>
                                        <th class="width2">آدرس</th>
                                        <th class="width"> شماره سریال</th>
                                        <th class="width2">مدل پیانو</th>
                                        <th class="width2">وضعیت</th>
                                        <th class="width2">زمان</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->regulate as $regulate)
                                        <tr class="tr">
                                            <td class="width2" data-column="شماره ">{{ $loop->index +1 }}</td>
                                            <td class="width2" data-column="شهر ">{{ $regulate->town->name }} </td>
                                            <td class="width2" data-column="آدرس ">{{ $regulate->address }}</td>
                                            <td class=" width"
                                                data-column="  شماره سریال "> {{ $regulate->serial }} </td>
                                            <td class=" width2" data-column="مدل پیانو ">{{ $regulate->model }}</td>
                                            <td class="width2 {{$regulate->statusClass()}}" data-column="وضعیت ">{{ $regulate->statusShow() }}</td>
                                            <td class="width2 " data-column="زمان  ">{{ $regulate->shamsi_date }}</td>
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
                                        شما تاکنون درخواست کوک و رگلاژی ثبت نکرده‌اید
                                    </h6>
                                </div>
                            </div>
                        @endif--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
