@extends('client.index')

@section('content')
    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container">

            <div class="row">
                @include('client.profile.profile_detail')
                <div class=" col-lg-9 max-height col-md-7 col-sm-12">
                    <div class="row">
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div id="filter-title" class="flex-box filter-title">
                                <div class="dot flex-box">
                                    <span></span>
                                </div>
                                <h2>
                                    خرید اشتراک ویژه
                                </h2>
                            </div>
                        </div>
                        @foreach($memberships as $membership)
                            <div class="space col-lg-12 col-md-12 col-sm-12">
                                <div class="white-box flex-box membership-item">
                                    <div class="membership-details">
                                        <h1>
                                            اشتراک <span>{{ $membership->title }}</span>
                                        </h1>
                                        <div class="flex-box">
                                            <h5>
                                                {{ $membership->description }}
                                            </h5>
                                            <span class="v-line"></span>
                                            <h5 class="green">
                                                {{ $membership->month }} روز مهلت اشتراک
                                            </h5>
                                        </div>

                                    </div>
                                    <div class="membership-details">
                                        <h2>
                                            <span>
                                               {{ number_format($membership->price) }}
                                            </span> تومان
                                        </h2>
                                        @php

                                            $had_buy = \App\Models\ClientToMemberShip::query()->where([
                                                'membership_id' => $membership->id,
                                                'client_id' => auth()->guard('clients')->user()->id
                                            ])->count() > 0;

                                        @endphp

                                        @if($had_buy)
                                            <a
                                               class="submit-button">
                                                <img src="{{asset('client/assets/icon/buy-membership.svg')}}">
                                                خریداری شده
                                            </a>
                                        @else
                                            <a href="{{ route('buy_member_ship' , $membership->id) }}"
                                               class="submit-button">
                                                <img src="{{asset('client/assets/icon/buy-membership.svg')}}">
                                                خرید اشتراک
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection