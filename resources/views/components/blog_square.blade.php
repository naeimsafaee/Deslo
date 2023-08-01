<a class="item" href="{{ route('single_blog' , $blog->slug) }}">
    <div class="white-box card-item blog-item">
        <div class="image-box">
            <img src="{{ Voyager::image($blog->thumbnail('thumbnail')) }}">
        </div>
        <h6>
            {{ $blog->title }}
        </h6>
        <p>
            {{ $blog->short_desc }}
        </p>
        <div class=" aline-left">
            <div class="flex-box more-item" href="{{ route('single_blog' , $blog->slug) }}">
                مطالعه بیشتر
                <img src="{{ asset('client/assets/icon/black2arrow.svg')  }}">
            </div>
        </div>
    </div>
</a>
