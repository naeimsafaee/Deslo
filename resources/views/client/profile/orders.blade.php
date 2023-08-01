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
                            سفارشات من
                        </h2>

                    </div>

                    @if(count($client->products) >0)
                    <table>
                        <thead>
                        <tr class="tr">
                            <th class="width"> سفارش#</th>
                            <th class="width">تاریخ  </th>
                            <th class="width">ارسال به</th>
                            <th class="width">مجموع سفارش</th>
                            <th class="width">وضعیت </th>
                            <th class="width">عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                      {{--  @foreach($transactions as $transaction)
                        <tr class="tr">
                            <td class="width" data-column="سفارش">{{ $transaction->wallet_transaction_id }}</td>
                            <td class="width " data-column="تاریخ">{{ $transaction->shamsi_date }} </td>
                            <td class="width " data-column="ارسال به">{{ $transaction->address }}</td>
                            <td class=" width" data-column="مجموع سفارش ">  {{ number_format($transaction->sum("price")) }}  تومان</td>
                            <td class=" width" data-column="وضعیت ">تحویل‌شده</td>
                            <td class="width green"  data-column="عملیات">
                                <a>
                                    مشاهده

                                </a>
                            </td>
                        </tr>
                        @endforeach--}}
                        </tbody>
                    </table>
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="center-dive">
                                <div id="empty-error" class="circle-box  icon-item">
                                    <img src="{{asset('client/assets/icon/cross.svg')}}">
                                </div>
                                <h6>
                                    شما تاکنون سفارشی ثبت نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection