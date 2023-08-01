<div class="col-sc-1 col-md-3 col-sm-4 col-6">
    <div class="album-archive">
        <a class="hover-box image-box" href="{{ route('single_music' , $music->slug) }}">
            <img src="{{ get_image($music->image) }}">
            <div class="content-onhover fadeIn-left">
                <img src="{{asset('client/assets/icon/play.svg')}}">
            </div>
            <div class="content-overlay"></div>

        </a>

        <h6>
            {{ $music->title }}
        </h6>
        <p>
            @if($music->artist->count() > 0 && $music->artist->first()->slug)
                <a href="{{ route('artist' , $music->artist->first()->slug) }}" style="color: inherit;">
                    {{$music->artist->first()->full_name}}
                </a>
            @endif
        </p>
    </div>

</div>
