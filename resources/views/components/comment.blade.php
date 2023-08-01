<div class="massage-row flex-box">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <div class="image-box">
                <img src="{{get_image($comment->client->image)}}">
            </div>

        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
            <div class="massage-content">
                <p class="massage-date">
                    {{ $comment->shamsi_date }}
                </p>
                <h5>
                    {{ $comment->client->full_name }}
                </h5>
                <p>
                    {{ $comment->description }}
                </p>
            </div>

        </div>
    </div>
</div>
