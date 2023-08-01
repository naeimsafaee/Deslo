<div class="space col-lg-2 col-md-4 col-sm-4 col-xs-6">
    <a href="{{ route('all_podcast', ['category_id' => $category->id]) }}" class="white-box flex-box emoji-item">
        <img src="{{ Voyager::image($category->icon) }}">
        <h2>
            {{$category->title}}
        </h2>
    </a>
</div>
