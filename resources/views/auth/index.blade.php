<!DOCTYPE html>
<html lang="far">
<head>
    <meta charset="UTF-8">
    <title>{{ setting('site.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('client/assets/css/master.css?x=2') }}" rel="stylesheet">
    <script src="{{ asset('client/assets/js/JQUERY.js') }}"></script>
    <script src="{{ asset('client/assets/js/BOOTSTRAP.js') }}"></script>
    <script src="{{ asset('client/assets/js/ajax.js') }}"></script>
    <link href="{{asset ('client/assets/css/persiandatepicker.css')}}" rel="stylesheet">
    <script src="{{asset('client/assets/js/persiandate.js')}}"></script>
    <script src="{{asset('client/assets/js/persiandatepicker.js')}}"></script>
</head>
<body>
    @include('errors.errorbar')

    @yield('content')

    @yield('optional_footer')
    <script src="{{ asset('client/assets/js/error.js') }}"></script>

</body>
</html>
