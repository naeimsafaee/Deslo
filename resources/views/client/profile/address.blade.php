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
                            آدرس‌های من
                        </h2>

                    </div>
                    @if(count($client->addresses)>0)
                    <table>
                        <thead>
                        <tr class="tr">
                            <th class="smaill-item">عنوان  </th>
                            <th class="width">استان  </th>
                            <th class="width">شهر    </th>
                            <th class="smaill-item">آدرس دقیق</th>
                            <th class="width amaliyat">عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->addresses as $address)
                        <tr class="tr">
                            <td class="smaill-item" data-column=" عنوان  "> {{ $address->title }} </td>
                            <td class="width " data-column="استان ">{{ $address->town->name }}</td>
                            <td class="width " data-column="شهر   ">{{ $address->city->name }}</td>
                            <td class=" smaill-item" data-column="آدرس دقیق">{{ $address->address }}</td>
                            <td class="width amaliyat "  data-column="عملیات">

                                <a href="{{route('edit_profile_address', ['address' => $address])}}" class="green">
                                    ویرایش
                                </a>
                                <a href="{{route('delete_profile_address', ['address' => $address])}}" class="date">
                                    حذف
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
                                    شما تاکنون آدرسی ثبت نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
