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
                                        درخواست‌های باربری
                                    </h2>

                                </div>

                                <a class="submit-button button flex-box" href="{{ route('new_pickup') }}">
                                    <img class="white-pluse" src="{{asset('client/assets/icon/white-pluse.svg')}}">
                                    درخواست جدید

                                </a>

                            </div>
                        </div>
                        @if(count($client->pickup)>0)
                            <div class="col-lg-12 col-md-12">
                                <table class="table1">
                                    <thead>
                                    <tr class="tr">
                                        <th class="width2">شماره </th>
                                        <th class="width2">شهر   </th>
                                        <th class="width2">آدرس </th>
                                        <th class="width2">نوع پیانو</th>
                                        <th class="width2">مدل پیانو </th>
                                        <th class="width2">وضعیت  </th>
                                        <th class="width2">زمان  </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($client->pickup as $pickup)
                                        <tr class="tr">
                                            <td class="width2" data-column="شماره ">{{ $loop->index+1 }}</td>
                                            <td class="width2 " data-column="شهر ">
                                                @if($pickup->town)
                                                    {{ $pickup->town->name }}
                                                @endif
                                            </td>
                                            <td class="width2 single-line"
                                                data-column="آدرس ">{{ $pickup->address }}</td>
                                            <td class=" width2" data-column="نوع پیانو ">{{ $pickup->piano_type }}</td>
                                            <td class=" width2" data-column="مدل پیانو ">{{ $pickup->model }}</td>
                                            <td class="width2 {{$pickup->statusClass()}}"
                                                data-column="وضعیت ">{{ $pickup->statusShow() }}</td>
                                            <td class="width2 " data-column="زمان  ">{{ $pickup->shamsi_date }}</td>
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
                                        شما تاکنون درخواست باربری ثبت نکرده‌اید
                                    </h6>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
