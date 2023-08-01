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
                            اقساط من
                        </h2>

                    </div>
                    @if(count($client->installments) > 0)
                        <table>
                            <thead>
                            <tr class="tr">
                                <th class="width"> شماره قسط</th>
                                <th class="smaill-item"> شماره سفارش مربوطه</th>
                                <th class="width">مبلغ</th>
                                <th class="width">وضعیت</th>
                                <th class="width ">مهلت پرداخت</th>
                                <th class="width amaliyat">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($client->installments as $installment)
                                <tr class="tr">
                                    <td class="width" data-column="  شماره قسط   "> {{ $loop->index+1 }} </td>
                                    <td class="smaill-item green"
                                        data-column=" شماره سفارش مربوطه "> {{ $installment->order }} </td>
                                    <td class="width " data-column="مبلغ    "> {{ number_format($installment->price) }}
                                        تومان
                                    </td>
                                    <td class="width "
                                        data-column="وضعیت"> {{ config('Constants.installment')[$installment->status] }} </td>
                                    <td class="pay-time width" data-column="مهلت پرداخت">
                                        {{ \Morilog\Jalali\Jalalian::fromDateTime($installment->time)->format('Y/m/d') }}
                                        @if(\Carbon\Carbon::parse($installment->time)->isPast() && $installment->status != 2)
                                            <p class="">
                                                {{ \Carbon\Carbon::parse($installment->time)->diffInDays(\Carbon\Carbon::now()) + 1 }}
                                                روز گذشته
                                            </p>
                                        @endif
                                    </td>
                                    <td class="width amaliyat " data-column="عملیات">

                                        @if($installment->status == 0)
                                            <a class=" pay-button pay-button2 flex-box">
                                                در انتظار بررسی
                                            </a>
                                        @elseif($installment->status == 1)
                                            <a class=" pay-button flex-box" href="{{ route('pay_installment' , $installment->id) }}">
                                                پرداخت‌
                                            </a>
                                        @else
                                            <a class="green pay flex-box" style="justify-content: end">
                                                <img src="{{ asset('client/assets/icon/check2.svg') }}">
                                                پرداخت شده
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
                                    شما تاکنون خرید اقساطی نکرده‌اید
                                </h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
