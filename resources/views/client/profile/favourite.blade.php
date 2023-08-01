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
                            علاقه مندی ها
                        </h2>

                    </div>

                    @if(count($client->favourite) >0)
                        <table>
                            <thead>
                            <tr class="tr">
                                <th class="big-item"> نام محصول</th>
                                <th class="width">عملیات </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($client->favourite as $favourite)
                                <tr class="tr">
                                    <td class="big-item" data-column=" نام فایل">{{ $favourite->product->name }}</td>
                                    <td class="width green"  data-column="عملیات">
                                        <a href="{{ route('single_product' ,$favourite->product->slug) }}" class="green pay flex-box">
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
                                    شما تاکنون محصولی به علاقه مندی اضافه نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
