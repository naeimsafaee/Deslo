<div class="filter-item radio-wrapper">
    <input type="checkbox" id="{{'category-' . $key}}" name="category[]"
           @if(request()->has('category') && request()->category == $category->id) checked
           @endif value="{{ $category->id}}">
    <label for="{{'category-' . $key}}">
        {{ $category->title }}
        {{--<p>
            {{ $brand->en_name }}
        </p>--}}
    </label>
</div>
