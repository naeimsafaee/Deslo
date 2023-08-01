<div class='filter'>
    <img class="closemenu" src="{{ asset('client/assets/icon/closemenu.svg') }}">
    <a href="{{ route('home') }}" style="padding: 0 !important; margin: 0 !important;"><img
                src="{{ asset('client/assets/icon/logo.svg')  }}"></a>

    @if(auth()->guard('clients')->check())

        <div class="profile-box">
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
                <img src="{{ asset('client/assets/icon/heart.svg') }}">
                علاقه‌مندی‌های من
            </a>
            <a class="flex-box profile-item" href="{{ route('logout') }}">
                <img src="{{ asset('client/assets/icon/logout.svg')  }}">
                خروج از حساب کاربری
            </a>
        </div>

    @else

        <div class="profile-box">
            <a style="color: inherit" href="{{ route('profile') }}" class="flex-box profile-item">
                <img src="{{ asset('client/assets/icon/account.svg')  }}">
                ورود / ثبت نام
            </a>
        </div>

    @endif

    <a class='title_items flex-box' href="{{ route('home') }}">
        صفحه اصلی
    </a>

    @foreach(\App\Models\ProductCategory::all() as $category)
        <a class='title_items flex-box'>
            {{ $category->title }}
            <img src="{{ asset('client/assets/icon/black2arrow.svg')  }}">
        </a>
        <ul class="main-list">

        @foreach($category->groups as $group)

                <li class="main-list-item">
                    <a class="flex-box">
                        {{ $group->title }}
                        <img src="{{ asset('client/assets/icon/black2arrow.svg')  }}">
                    </a>
                    <ul class="inner-list">
                        @foreach($group->subcategories as $sub_category)
                            <li>
                                <a style="color: inherit !important;"
                                   href="{{route('search', ['category' => $sub_category->id ]) . ($sub_category->is_book === 1 ? "&search_in=books" : "") }}">
                                    {{ $sub_category->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
        @endforeach

        </ul>
    @endforeach


    <a class='title_items flex-box' href="{{route('search', ['sort' => 'discounts'])}}">
        تخفیف ها
    </a>
    @php
        $menus = menu('header', '_json');
    @endphp

    @foreach($menus as $menu)
        <a class='title_items flex-box' href="{{ $menu->url }}">
            {{ $menu->title }}
        </a>
    @endforeach
</div>


<script>
    $("li.main-list-item a.flex-box").click(function (e) {
        e.preventDefault();
        console.log($(this));
        console.log($(this).next("ul"));
        // console.log($(this));
        // if(== "flex-box")

        if ($(this).next("ul").length !== 0) {


            e.preventDefault();
            console.log("lknkldnfkl")
        } else {

            // console.log($(this).attr("href"))

            window.location.href = $(this).attr('href');

        }


    });
</script>
