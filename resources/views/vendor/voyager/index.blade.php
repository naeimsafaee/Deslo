@extends('voyager::master')

@section('content')
    @if (session('status'))
        <div class="alert dashboardalert @if(session('success')==true) success @else error @endif">
            {{ session('status') }}
        </div>
    @endif
    @php
        $comment = \App\Models\CommentProduct::query()->where('is_active' , false)->count();
        $regulate = \App\Models\Regulate::query()->where('status' , 1)->count();
        $info = \App\Models\InstallmentInfo::query()->where('status' , 0)->count();
        $orders = \App\Models\OrdersProduct::query()->where('status' , 0)->count();
    @endphp

    @if($comment > 0 || $regulate > 0)
        <div class="alert dashboardalert success">
            شما
            {{ fa_number($comment) }}
            نظر خوانده نشده
            <br>
            و
            {{ fa_number($regulate) }}
            درخواست کوک و رگلاژ
            <br>
            و
            {{ fa_number($info) }}
            درخواست خرید اقساطی
            <br>
            و
            {{ fa_number($orders) }}
            سفارش جدید دارید
        </div>
    @endif
    @if (App\Models\Sms::first()->stock<=30)
        <div class="alert dashboardalert">
            {{__('hotdesk.lowsms')}}
        </div>
    @endif
    <div class="dashboard">
        @if(Auth::user()->unreadsupport()->exists())
            <div class="notifications">
                <h3>{{__('hotdesk.notifications')}}</h3>
                <a href="{{route('voyager.supports.index')}}" title=""
                   class="messages">{{Auth::user()->unreadsupport()->count()}} {{__('hotdesk.notifications_unreadmessage')}}</a>
            </div>
        @endif
        <div class="chart">
            <h3>{{__('hotdesk.chart')}}</h3>
            <div class="box">
                <ul>
                    <li class="active" data-id="users"
                        data-info="{{Auth::user()->locale=='fa' ? fa_number(App\User::count()) : App\User::count()}} {{__('hotdesk.user')}}">{{__('hotdesk.users')}}</li>

                </ul>
                <span>{{Auth::user()->locale=='fa' ? fa_number(App\User::count()) : App\User::count()}} {{__('hotdesk.user')}}</span>
                <canvas id="userchart" width="100%" height="160px"></canvas>
            </div>
        </div>
        <div class="clear"></div>
        <div class="tools">
            @include('vendor.voyager.dashboard.smspack')
            @include('vendor.voyager.dashboard.personalizemenus')
        </div>
    </div>
@stop
