@if (\Session::has('success'))
    <div class="error-message error-style">
        {!! \Session::get('success') !!}
    </div>
@endif
@if (\Session::has('warning'))
    <div id="error-style-2" class="error-message error-style">
        {!! \Session::get('warning') !!}
    </div>
@endif
@if (\Session::has('error'))
    <div id="error-style-3" class="error-message error-style">
        {!! \Session::get('error') !!}
    </div>
@endif
