<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="{{ setting('site.google_analytics_tracking_id') }}" />

    {!! meta() !!}
    @yield('meta_tags')

    <title>{{ setting('site.title') }}</title>


    <link href="{{ asset('client/assets/css/lightgallery-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/css/cloudzoom.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('client/assets/css/animate.css') }}" rel="stylesheet">


    <link href="{{ asset('client/assets/css/master.css') }}?x=1223" rel="stylesheet">
    <link href="{{ asset('client/assets/css/Owl-Carousel.css') }}?x=153" rel="stylesheet">
    <link href="{{ asset('client/assets/css/Owl.css') }}?x=153" rel="stylesheet">
    <script src="{{ asset('client/assets/js/JQUERY.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/BOOTSTRAP.js') }}"></script>
    <script src="{{ asset('client/assets/js/lightgallery.umd.js') }}"></script>
    <script src="{{ asset('client/assets/js/lg-fullscreen.umd.js') }}"></script>
    <script src="{{ asset('client/assets/js/lg-medium-zoom.umd.js') }}"></script>
    <script src="{{ asset('client/assets/js/lg-zoom.umd.js') }}"></script>

    <script src="{{ asset('client/assets/js/cloudzoom.js') }}?x=1223"></script>
    <script src="{{ asset('client/assets/js/ajax.js') }}"></script>
    <script src="{{ asset('client/assets/js/Owl-Carousel.js') }}"></script>

    <link href="{{asset('client/assets/css/persiandatepicker.css')}}" rel="stylesheet">
    <script src="{{asset('client/assets/js/persiandate.js')}}"></script>
    <script src="{{asset('client/assets/js/persiandatepicker.js')}}"></script>

    @yield('optional_header')

    <!--BEGIN RAYCHAT CODE-->
    <script type="text/javascript">!function(){function t(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,localStorage.getItem("rayToken")?t.src="https://app.raychat.io/scripts/js/"+o+"?rid="+localStorage.getItem("rayToken")+"&href="+window.location.href:t.src="https://app.raychat.io/scripts/js/"+o+"?href="+window.location.href;var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}var e=document,a=window,o="188782bb-c4ab-4165-b40d-8fe313a81134";"complete"==e.readyState?t():a.attachEvent?a.attachEvent("onload",t):a.addEventListener("load",t,!1)}();</script>
    <!--END RAYCHAT CODE-->

</head>
<body class="body">

<div class="container-fluid @yield('class')">
    <div id="search" class="fade">
        <a href="#" class="close-btn" id="close-search">
            <img src="{{asset('client/assets/icon/search-close.svg')}}">
        </a>
        <form action="{{ route('search') }}" method="get">
            <input placeholder="جستجو کنید" id="searchbox" type="search"/>
            <input type="hidden" name="search_in" value="products">
        </form>
    </div>

    @yield('modal')
    <div class="overlay2"></div>

    @include('client.mobile_menu')

    <div class="row">
        @include('client.header')

        @yield('content')

        @include('client.footer')
    </div>
</div>

<script src="{{asset('client/assets/js/master.js?x=2')}}"></script>
<script src="{{asset('client/assets/js/scroll.js')}}"></script>
<script src="{{asset('client/assets/js/dropdown.js')}}"></script>
<script src="{{ asset('client/assets/js/error.js') }}"></script>

@yield('optional_footer')

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XH6J1CBH8C"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-XH6J1CBH8C');
</script>

</body>
</html>
