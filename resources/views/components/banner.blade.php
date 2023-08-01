<div class="space col-lg-6 col-md-6 col-sm-12 col-xs-12">

    <a href="{{$banner->link}}" style="width: 100%; height: 100%; position:absolute; display:block;"></a>


    <div class="flex-box blue-box"
         style="background: radial-gradient(163.86% 163.86% at 50% 50%, {{ $banner->color_code }} 0%, {{ $banner->color_code }} 100%);">

        @if($banner->discount)
            <div class="ribbon">
                <a>
                    تخفیف تا
                    <br/>
                    {{ fa_number($banner->discount) . ' %' }}
                </a>
            </div>
        @endif

        <img src="{{ get_image($banner->image)  }}">
        <div class="offers-details">
            <h4>
                {{ $banner->title }}
            </h4>
            @if($banner->price != 0)
                <h2>
                    {{ fa_number(number_format($banner->price)) }} تومان
                </h2>
            @endif
            @if($banner->price_1 != 0)
                <h5>
                    {{ fa_number(number_format($banner->price_1)) }} تومان
                </h5>
            @endif
            <a href="{{$banner->link}}" class="flex-box details">
                مشاهده جزئیات
                <img src="{{ asset('client/assets/icon/white2arrow.svg')  }}">
            </a>
        </div>
    </div>

</div>
