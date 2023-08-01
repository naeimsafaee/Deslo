<div class="filter-item radio-wrapper">
    <input type="checkbox" id="{{'blog-' . $key}}" name="category[]" value="{{$category->id}}">
    <label for="{{'blog-' . $key}}">
        {{ $category->title }}
    </label>
</div>
