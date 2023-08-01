<div class="space col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a href="{{ route('single_product' , $product->slug) }}">
        <div class="card-item white-box">
            @if($product->is_discounted && $product->stock > 0)
                <div class="ribbon" style="top: -6px;">
                <span style="padding: 0 !important;">
                    {{ fa_number($product->discountPercent())  . ' %'}}
                    <br/>
                    تخفیف
                </span>
                </div>
            @endif
            <div class="image-box">
                <img src="{{ get_cropped_image($product->main_image) }}">
            </div>
            <div class="rank flex-box">
                <img src="{{ asset('client/assets/icon/fill-star.svg') }}">
                <span>
                {{ fa_number($product->rate)}}
            </span>
                <span>
                 /۵
            </span>
            </div>
            <h6 style="color: var(--main-font-color);">
                {{ $product->name }}
            </h6>
            <div class="aline-left">
                @if($product->stock > 0)
                    <div class="price-item">
                        @if($product->is_discounted)
                            <span style="margin-right: 10px">
                                {{ fa_number(number_format($product->price)) }}
                            </span>
                        @endif
                        <h5>
                            {{ fa_number(number_format($product->final_price)) }}
                        </h5>

                        <p @if($product->is_discounted) style="margin-left: 10px" @endif>

                            تومان
                        </p>
                    </div>
                @else
                    <span style="color: var(--second-font-color);margin-bottom: 20px;">
                            ناموجود
                        </span>
                @endif

            </div>
        </div>
    </a>
</div>
