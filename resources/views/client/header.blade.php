<div class="col-lg-12">
    @include('errors.errorbar')

    <header>
        <nav>
            <div class="top-header flex-box">
                <div class="right-nav flex-box">
                    <img class="mobile-menu mobile" src="{{ asset('client/assets/icon/menu.svg')  }}">

                    @if(auth()->guard('clients')->check())
                        <div id="popup-open1" class="flex-box button account">
                            <img src="{{ asset('client/assets/icon/account.svg')  }}">
                            حساب
                            کاربری
                            <div id="popup1" class="profile-box">
                                <div class="first-row">
                                    <div class="flex-box">
                                        <div class="image-box">
                                            <img src="{{ get_image(auth()->guard('clients')->user()->image)  }}">
                                        </div>
                                        <div>
                                            <h5>
                                                {{ auth()->guard('clients')->user()->full_name }}
                                            </h5>
                                            <a style="color: inherit" href="{{ route('profile') }}">
                                                مشاهده حساب کاربری
                                            </a>
                                        </div>

                                    </div>

                                </div>
                                <a class="flex-box profile-item" href="{{ route('profile_orders') }}">
                                    <img src="{{ asset('client/assets/icon/serial-icone.svg')  }}">
                                    سفارش‌های من
                                </a>
                                <a class="flex-box profile-item" href="{{ route('profile_favorite') }}">
                                    <img src="{{ asset('client/assets/icon/heart.svg')  }}">
                                    علاقه‌مندی‌های من
                                </a>
                                <a class="flex-box profile-item" href="{{ route('logout') }}">
                                    <img src="{{ asset('client/assets/icon/logout.svg')  }}">
                                    خروج از حساب کاربری
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex-box button account">

                            <a style="color: inherit" href="{{ route('profile') }}">
                                <img src="{{ asset('client/assets/icon/account.svg')  }}">
                                ورود / ثبت نام
                            </a>
                        </div>
                    @endif

                    <div id="popup-open2" class="flex-box button submit-button">
                        <img src="{{ asset('client/assets/icon/basket.svg')  }}">
                        سبد خرید
                        <div id="popup2" class="profile-box shop-item">
                            @php

                                $cart = \App\Models\Cart::query();
                                    if(auth()->guard('clients')->check()){
                                        $cart = $cart->where('client_id' , auth()->guard('clients')->user()->id)->with('product')->get();
                                    } else {
                                        $cart = $cart->where('ip' , request()->ip())->with('product')->get();
                                    }
                            @endphp
                            @if($cart->count() > 0)
                                @foreach($cart as $c)
                                    @if($c->product)
                                        <div class="flex-box order-item">
                                            <img style="margin-top: -14px;"
                                                 src="{{ get_cropped_image($c->product->main_image , "small")  }}">
                                            <div class="order-content">
                                                <p>
                                                    {{ $c->product->name }}
                                                </p>
                                                <p>
                                                    {{ $c->product->categories->first()->title ?? ""}}
                                                </p>
                                                <div class="flex-box add-order">
                                                    <div>
                                                        @if($c->product->is_discounted)
                                                            <p class="grey">
                                                                {{ fa_number(number_format($c->product->price)) }}تومان
                                                            </p>
                                                        @endif

                                                        <h6>
                                                            {{ fa_number(number_format($c->product->final_price)) }}
                                                            تومان
                                                        </h6>
                                                    </div>
                                                    <div class="add-remove">
                                                        <p class="text-center grey">
                                                            تعداد
                                                        </p>
                                                        <div class="flex-box">
                                                                                <span class="add flex-box"><a
                                                                                            href="{{ route('increase_cart_item' , $c->product->id) }}"
                                                                                            style="color: inherit!important;">+</a></span>
                                                            <span>{{ fa_number($c->count) }}</span>
                                                            <span class="remove flex-box"><a
                                                                        href="{{ route('remove_cart_item' , $c->product->id) }}"
                                                                        style="color: inherit!important;">-</a></span>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                                <div class="order-content total-price flex-box add-order">
                                    <p>
                                        مجموع سبد خرید
                                    </p>
                                    <div>
                                        <h6>
                                            {{ fa_number(number_format($cart->sum('product_price'))) }}تومان
                                        </h6>
                                    </div>

                                </div>
                                <a class="submit-button" href="{{ route('cart') }}" style="margin: 0px !important;">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/tick.svg')  }}">
                                    </div>
                                    ویرایش و مشاهده سبد خرید
                                </a>

                            @else
                                <h6 style="color: #000">سبد خرید شما خالی است.</h6>
                            @endif
                        </div>

                    </div>

                    <div class="input-row">
                        <form action="{{ route('search') }}" method="get">
                            <input name="search" type="text" placeholder=" جستجو در دسلو" value="{{request('search')}}">
                            <img class="search" src="{{ asset('client/assets/icon/search.svg')  }}">

                            <div class="search-dropdown input-row">
                                <div class="custom-select">
                                    <img src="{{ asset('client/assets/icon/arrow.svg')  }}">
                                    <select name="search_in">
                                        <option value="products">محصولات</option>
                                        <option value="products" {{request('search_in') == 'products' ? 'selected' : ''}}>
                                            محصولات
                                        </option>
                                        <option value="books" {{request('search_in') == 'books' ? 'selected' : ''}}>کتاب
                                            ها
                                        </option>
                                        <option value="albums" {{request('search_in') == 'albums' ? 'selected' : ''}}>
                                            آلبوم ها
                                        </option>
                                        <option value="blog" {{request('search_in') == 'blog' ? 'selected' : ''}}>بلاگ
                                        </option>
                                    </select>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

                <div class="left-nav flex-box">
                    <img onclick="(() => { window.location = '{{ route('home') }}' })()" class="logo "
                         src="{{ asset('client/assets/icon/logo.svg')  }}">
                    <div class="flex-box">
                        <a class="phonecell" href="{{ 'tel:' . fa_number(setting('home.call'), true) }}">
                            <img src="{{ asset('client/assets/icon/phone.svg')  }}">
                        </a>
                        <div class="support-row">
                            <p>
                                {{ setting('home.above_call_text') }}
                            </p>
                            <h5>
                                {{ setting('home.call') }}
                            </h5>
                        </div>

                    </div>
                    <a class="bascket mobile" href="{{ route('cart') }}">
                        <img src="{{asset('client/assets/icon/shopping-basket%201.svg')}}">
                    </a>

                    <a class="bascket mobile search-icon">
                        <img src="{{asset('client/assets/icon/magnifying-glass-mobile.svg')}}">
                    </a>


                </div>


            </div>

            <div id="bottom-header" class="bottom-header flex-box">
                <div class="right-nav flex-box">
                    <div class="navbar-item ">
                        <ul class=" main-nav ">

                            <li class="nav-item">
                                <a style="color: inherit" class="header-item" href="{{ route('home') }}">
                                    صفحه اصلی
                                </a>
                            </li>

                            <li id="nav-item" class=" nav-item">
                                <a class="header-item">
                                    <img src="{{ asset('client/assets/icon/dastebandi.svg')  }}">
                                    دسته بندی محصولات
                                </a>

                                <div class="menu-container">
                                    <div class="menu">
                                        <ul>

                                            @foreach(\App\Models\ProductCategory::all() as $category)
                                                <li class="flex-box  menu-item">
                                                    <div class="flex-box">
                                                        <span></span>
                                                        {{ $category->title }}
                                                    </div>
                                                    <img src="{{ asset('client/assets/icon/green-arrow.svg')  }}">

                                                    <div class="submenu">
                                                        <div class="row">
                                                            @foreach($category->groups as $group)
                                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                                    <h6>
                                                                        {{ $group->title }}
                                                                    </h6>
                                                                    <ul>
                                                                        @foreach($group->subcategories as $sub_category)
                                                                            <li>
                                                                                <a style="color: inherit !important;"
                                                                                   href="{{route('search', ['category' => $sub_category->id ]) . ($sub_category->is_book === 1 ? "&search_in=books" : "") }}">
                                                                                    {{ $sub_category->title }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>

                                </div>


                            </li>

                            <li class="nav-item">
                                <a href="{{route('search', ['sort' => 'discounts'])}}" style="color: inherit"
                                   class="header-item">
                                    <img src="{{ asset('client/assets/icon/offer.svg')  }}">
                                    تخفیف ها
                                </a>
                            </li>

                            @php
                                $menus = menu('header', '_json');
                            @endphp

                            @foreach($menus as $menu)
                                <li class="nav-item">
                                    <a style="color: inherit" class="header-item" href="{{ $menu->url }}">
                                        {{ $menu->title }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        <div class="indicator"></div>

                    </div>

                </div>
                <div class="left-nav flex-box">
                    <ul class="social-icon">
                        <li>
                            <a href="{{setting('site.facebook')}}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M20 10C20 4.47768 15.5223 0 10 0C4.47768 0 0 4.47768 0 10C0 14.9911 3.65625 19.1281 8.4375 19.879V12.8915H5.89777V10H8.4375V7.79688C8.4375 5.29107 9.9308 3.9058 12.2147 3.9058C13.3089 3.9058 14.4536 4.10134 14.4536 4.10134V6.5625H13.192C11.9504 6.5625 11.5621 7.33304 11.5621 8.125V10H14.3353L13.8924 12.8915H11.5625V19.8799C16.3438 19.1295 20 14.9924 20 10Z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{setting('site.youtube')}}">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.8715 3.31253C19.8715 1.55449 18.5784 0.140252 16.9805 0.140252C14.8162 0.0390673 12.6089 0 10.3531 0H9.64989C7.39961 0 5.18839 0.0390674 3.02406 0.140643C1.43011 0.140643 0.136974 1.5627 0.136974 3.32073C0.039305 4.71114 -0.00210647 6.10194 0.000237572 7.49274C-0.00366917 8.88354 0.0406073 10.2756 0.133067 11.6691C0.133067 13.4271 1.4262 14.853 3.02015 14.853C5.29387 14.9585 7.6262 15.0054 9.99759 15.0015C12.3729 15.0093 14.6987 14.9598 16.975 14.853C18.5729 14.853 19.866 13.4271 19.866 11.6691C19.9598 10.2743 20.0028 8.88354 19.9989 7.48884C20.0077 6.09803 19.9653 4.70593 19.8715 3.31253ZM8.0872 11.3253V3.64851L13.752 7.48493L8.0872 11.3253Z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{setting('site.twitter')}}">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 1.89584C19.2498 2.22182 18.456 2.43658 17.6438 2.53334C18.4974 2.0335 19.1393 1.23941 19.4492 0.300007C18.6421 0.77192 17.7606 1.10304 16.8425 1.27917C16.4559 0.873978 15.9909 0.551634 15.4758 0.331734C14.9607 0.111834 14.4063 -0.00102805 13.8463 7.05601e-06C11.5788 7.05601e-06 9.74375 1.80834 9.74375 4.03751C9.74214 4.34758 9.77767 4.65672 9.84958 4.95834C8.22362 4.88212 6.63147 4.46733 5.17499 3.74053C3.71852 3.01373 2.42979 1.99091 1.39125 0.737507C1.02691 1.35172 0.834222 2.05253 0.833333 2.76667C0.833333 4.16667 1.56375 5.40417 2.66667 6.12917C2.01322 6.11367 1.37316 5.94072 0.800833 5.62501V5.67501C0.800833 7.63334 2.2175 9.26251 4.0925 9.63334C3.73991 9.72733 3.37657 9.77496 3.01167 9.77501C2.75274 9.77546 2.4944 9.75034 2.24042 9.70001C2.76167 11.3042 4.27875 12.4708 6.07583 12.5042C4.61557 13.6296 2.82276 14.2378 0.979167 14.2333C0.651924 14.2329 0.324986 14.2134 0 14.175C1.87549 15.3726 4.0556 16.0061 6.28083 16C13.8375 16 17.9658 9.84584 17.9658 4.50834C17.9658 4.33334 17.9613 4.15834 17.9529 3.98751C18.7542 3.41753 19.4474 2.70922 20 1.89584Z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{setting('site.instagram')}}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1665 1.66652C15.2707 1.66982 16.3286 2.10989 17.1094 2.89064C17.8901 3.67138 18.3302 4.72935 18.3335 5.83348V14.1665C18.3302 15.2707 17.8901 16.3286 17.1094 17.1094C16.3286 17.8901 15.2707 18.3302 14.1665 18.3335H5.83348C4.72935 18.3302 3.67138 17.8901 2.89064 17.1094C2.10989 16.3286 1.66982 15.2707 1.66652 14.1665V5.83348C1.66982 4.72935 2.10989 3.67138 2.89064 2.89064C3.67138 2.10989 4.72935 1.66982 5.83348 1.66652H14.1665V1.66652ZM14.1665 0H5.83348C2.625 0 0 2.625 0 5.83348V14.1665C0 17.375 2.625 20 5.83348 20H14.1665C17.375 20 20 17.375 20 14.1665V5.83348C20 2.625 17.375 0 14.1665 0V0Z"/>
                                    <path d="M15.4165 5.83361C15.1693 5.83361 14.9276 5.76029 14.7221 5.62294C14.5165 5.48559 14.3563 5.29037 14.2617 5.06196C14.1671 4.83355 14.1423 4.58222 14.1905 4.33974C14.2388 4.09727 14.3578 3.87454 14.5326 3.69972C14.7075 3.52491 14.9302 3.40586 15.1727 3.35762C15.4151 3.30939 15.6665 3.33415 15.8949 3.42876C16.1233 3.52337 16.3185 3.68358 16.4559 3.88914C16.5932 4.0947 16.6665 4.33638 16.6665 4.58361C16.6669 4.74786 16.6348 4.91056 16.5721 5.06238C16.5094 5.21419 16.4173 5.35213 16.3012 5.46828C16.185 5.58442 16.0471 5.67648 15.8953 5.73917C15.7435 5.80187 15.5808 5.83396 15.4165 5.83361V5.83361ZM10 6.66664C10.6593 6.66664 11.3038 6.86215 11.852 7.22843C12.4002 7.59472 12.8274 8.11534 13.0797 8.72445C13.332 9.33357 13.3981 10.0038 13.2694 10.6505C13.1408 11.2971 12.8233 11.8911 12.3571 12.3572C11.8909 12.8234 11.297 13.1409 10.6503 13.2696C10.0037 13.3982 9.33345 13.3322 8.72433 13.0799C8.11522 12.8276 7.5946 12.4003 7.22831 11.8521C6.86203 11.3039 6.66652 10.6594 6.66652 10.0001C6.66747 9.11632 7.01897 8.26898 7.64392 7.64404C8.26886 7.01909 9.1162 6.66759 10 6.66664V6.66664ZM10 5.00012C9.0111 5.00012 8.0444 5.29337 7.22215 5.84277C6.39991 6.39218 5.75904 7.17307 5.3806 8.08671C5.00217 9.00034 4.90315 10.0057 5.09608 10.9756C5.289 11.9455 5.76521 12.8364 6.46447 13.5357C7.16373 14.2349 8.05465 14.7111 9.02455 14.904C9.99446 15.097 10.9998 14.998 11.9134 14.6195C12.827 14.2411 13.6079 13.6002 14.1574 12.778C14.7068 11.9557 15 10.989 15 10.0001C15 8.67404 14.4732 7.40227 13.5355 6.46459C12.5979 5.52691 11.3261 5.00012 10 5.00012V5.00012Z"/>
                                </svg>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

        @yield('top_bar')

    </header>

</div>
