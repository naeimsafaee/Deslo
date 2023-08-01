<div class="filter-item radio-wrapper">
    <input type="checkbox" id="{{'brand-' . $key}}" name="brand[]" value="{{$brand->id}}">
    <label for="{{'brand-' . $key}}">
        {{ $brand->name }}
        <p>
            {{ $brand->en_name }}
        </p>
    </label>
</div>
