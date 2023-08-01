<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
    <div class="white-box card-item blog-item mag-item">
        <div class="row">
            <div class=" col-lg-3 col-md-12 col-sm-12">
                <div class="image-box">
                    <img src="{{ Voyager::image($blog->thumbnail('thumbnail')) }}">
                </div>

            </div>
            <div class="mag-content col-lg-9 col-md-12 col-sm-12">
                <h6>
                    {{$blog->title}}
                </h6>
                <p>
                    {{ $blog->short_desc }}
                </p>
                <div class=" aline-left">
                    <div class="date flex-box" style="direction: rtl">
                        <img src="{{asset('client/assets/icon/clock.svg')}}">
                        {{fa_number($blog->shamsi_date)}}
                    </div>
                    <a class="flex-box more-item" href="{{ route('single_blog' , $blog->slug) }}">
                        مطالعه بیشتر
                        <img src="{{asset('client/assets/icon/black2arrow.svg')}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
