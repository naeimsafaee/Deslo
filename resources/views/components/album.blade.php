<div class="col-sc-1 col-md-3 col-sm-4 col-6">
    <div class="album-archive">
        <a class="hover-box image-box" href="{{route('album' , $album->slug)}}">
            <img src="{{ get_image($album->image) }}">
            <div class="content-onhover fadeIn-left">
                <img src="{{asset('client/assets/icon/play.svg')}}">
            </div>
            <div class="content-overlay"></div>

        </a>

        <h6>
            {{ $album->title }}
        </h6>
        @if($album->artist && $album->artist->count() > 0)
            <p>
                @foreach($album->artist as $artist)
                    <a href="{{ route('artist' , $artist->slug) }}" style="color: inherit;">
                        {{ $artist->full_name}}
                    </a>
                    @if(!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
        @endif
    </div>

</div>
