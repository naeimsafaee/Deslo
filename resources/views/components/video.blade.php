<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="album-archive">
        <a class="hover-box image-box" href="{{ route('video' , $video["slug"]) }}">
            <img src="{{ get_image($video["image"]) }}">
            <div class="content-onhover fadeIn-left">
                <img src="{{asset('client/assets/icon/play.svg')}}">
            </div>
            <div class="content-overlay"></div>
        </a>
        <h6>
            {{ $video->title }}
        </h6>
        <p>
            <a href="{{ route('artist' , $video->artist->slug) }}" style = "color: inherit;">
                {{$video->artist->full_name}}
            </a>
        </p>
    </div>

</div>
