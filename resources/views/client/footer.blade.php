<div class="col-lg-12">
    <footer>
        <div class="top-footer">
            <div class="footer">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h2>
                                    {{ setting('home.footer_1') }}
                                </h2>
                                <ul>
                                    @php
                                        $menus = menu('footer_1', '_json');
                                    @endphp

                                    @foreach($menus as $menu)
                                    <li>
                                        <a href="{{ $menu->url }}">
                                            <span>

                                            </span>
                                           {{ $menu->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h2>
                                    {{ setting('home.footer_2') }}
                                </h2>
                                <ul>
                                    @php
                                        $menus = menu('footer_2', '_json');
                                    @endphp

                                    @foreach($menus as $menu)
                                        <li>
                                            <a href="{{ $menu->url }}">
                                            <span>

                                            </span>
                                                {{ $menu->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h2>
                                    {{ setting('home.footer_3') }}
                                </h2>
                                <ul>
                                    @php
                                        $menus = menu('footer_3', '_json');
                                    @endphp

                                    @foreach($menus as $menu)
                                        <li>
                                            <a href="{{ $menu->url }}">
                                            <span>

                                            </span>
                                                {{ $menu->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">


                        <h2>
                            {{ setting('home.about_us_title') }}
                        </h2>
                        <p>
                            {!! setting('home.about_us_text') !!}
                        </p>

                        <h2>
                            آدرس
                        </h2>
                        <p>
                            {!! setting('home.address') !!}
                        </p>

                        <div class="footer-photo">

                            <a class="footer-support" referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=259128&amp;Code=qaBDsdql1fKKp99wSgGF"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=259128&amp;Code=qaBDsdql1fKKp99wSgGF" alt="" style="cursor:pointer" id="qaBDsdql1fKKp99wSgGF"></a>

<!--
                            <img class="footer-support" src="">
                            <img class="footer-support" src="">
-->

                        </div>


                    </div>


                </div>

            </div>
        </div>
        <div class="bottom-footer">
            <div class="footer flex-box">
                <div class="row">
                    <div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
                        <div class="right-nav">
                            <p>
                                کلیه حقوق مادی و معنوی این وب سایت برای دسلو پیانو محفوظ است
                            </p>
                        </div>

                    </div>
                    <div class="col-lg-2 col-md-5 col-sm-4 col-xs-12">
                        <img src="{{ asset('client/assets/icon/logo.svg')  }}">

                    </div>
                </div>

            </div>
        </div>

    </footer>

</div>