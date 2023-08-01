@extends('client.index')
@section('content')

    <div class="fade-page"></div>
    <div class="overlay">
    </div>
    <div class="col-lg-12">
        <div id="container" class="container max-height">

            <div class="row">
                <div class="space col-lg-12 col-md-12 col-sm-12">
                    <div class="flex-box back-item">
                        <a href="{{route('home')}}">
                            صفحه اصلی
                        </a>
                        @if(count($product->categories) > 0)
                            <a class="arrow">
                                >
                            </a>
                            <a href="{{route('search', ['category' => $product->categories->first()->id])}}">
                                {{$product->categories->first()->title}}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box blog-item payment-row">
                                <div class="row margin">
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-12">
                                        <div class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                شما در حال ارسال نظر درباره محصول روبرو می‌باشید
                                            </h2>

                                        </div>

                                        {{--                                        <form class="input-row comment-reply"></form>--}}
                                        <textarea class="textComment" style="height: 270px;"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-5 col-sm-5 col-12">
                                        <div class="product-details">
                                            <img src="{{ get_image($product->main_image) }}">
                                            <h2>
                                                {{ $product->name }}
                                            </h2>
                                            <p class="date">
                                                {{ $product->sub_title }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="margin row">
                        <div class="space  col-lg-6 col-md-6 col-sm-6 col-12">
                            <div>
                                <form class="form">

                                    <div class="form-container">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input id="todo" type="text" class="form-input"
                                               placeholder="نکته مثبت مد نظرتان را بنویسید..." name="text">
                                        <button type="submit" class="add-item">
                                            <svg width="19" height="14" viewBox="0 0 19 14" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.08203 13.7188C7.43359 14.0703 8.03125 14.0703 8.38281 13.7188L18.7188 3.38281C19.0703 3.03125 19.0703 2.43359 18.7188 2.08203L17.4531 0.816406C17.1016 0.464844 16.5391 0.464844 16.1875 0.816406L7.75 9.25391L3.77734 5.31641C3.42578 4.96484 2.86328 4.96484 2.51172 5.31641L1.24609 6.58203C0.894531 6.93359 0.894531 7.53125 1.24609 7.88281L7.08203 13.7188Z"/>
                                            </svg>
                                        </button>
                                    </div>

                                </form>

                                <div class="list">
                                    {{--
                                                                        <div class="flex-box">
                                    --}}
                                    {{--                                        <h5>قیمت مقرون‌به‌صرفه</h5>--}}{{--

                                                                            <svg class="glyphicon-remove" width="13" height="13" viewBox="0 0 13 13"
                                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M9.13281 6.25L12.6484 2.73438C13.1055 2.3125 13.1055 1.60938 12.6484 1.1875L11.875 0.414062C11.4531 -0.0429688 10.75 -0.0429688 10.3281 0.414062L6.8125 3.92969L3.26172 0.414062C2.83984 -0.0429688 2.13672 -0.0429688 1.71484 0.414062L0.941406 1.1875C0.484375 1.60938 0.484375 2.3125 0.941406 2.73438L4.45703 6.25L0.941406 9.80078C0.484375 10.2227 0.484375 10.9258 0.941406 11.3477L1.71484 12.1211C2.13672 12.5781 2.83984 12.5781 3.26172 12.1211L6.8125 8.60547L10.3281 12.1211C10.75 12.5781 11.4531 12.5781 11.875 12.1211L12.6484 11.3477C13.1055 10.9258 13.1055 10.2227 12.6484 9.80078L9.13281 6.25Z"/>
                                                                            </svg>
                                                                        </div>
                                    --}}
                                </div>
                            </div>
                        </div>
                        <div class="space col-lg-6 col-md-6 col-sm-6 col-12">
                            <form class="form2">
                                <div class="form-container">
                                    <input id="todo2" type="text" class="form-input"
                                           placeholder="نکته منفی مد نظرتان را بنویسید...">
                                    <button type="submit" class="add-item">
                                        <svg width="19" height="14" viewBox="0 0 19 14" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.08203 13.7188C7.43359 14.0703 8.03125 14.0703 8.38281 13.7188L18.7188 3.38281C19.0703 3.03125 19.0703 2.43359 18.7188 2.08203L17.4531 0.816406C17.1016 0.464844 16.5391 0.464844 16.1875 0.816406L7.75 9.25391L3.77734 5.31641C3.42578 4.96484 2.86328 4.96484 2.51172 5.31641L1.24609 6.58203C0.894531 6.93359 0.894531 7.53125 1.24609 7.88281L7.08203 13.7188Z"/>
                                        </svg>
                                    </button>
                                </div>

                            </form>
                            <div class="list2">
                                {{--
                                                                <div class="flex-box redListItem">
                                --}}
                                {{--                                    <h5>قیمت مقرون‌به‌صرفه</h5>--}}{{--

                                                                    <svg class="glyphicon-remove" width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M9.13281 6.25L12.6484 2.73438C13.1055 2.3125 13.1055 1.60938 12.6484 1.1875L11.875 0.414062C11.4531 -0.0429688 10.75 -0.0429688 10.3281 0.414062L6.8125 3.92969L3.26172 0.414062C2.83984 -0.0429688 2.13672 -0.0429688 1.71484 0.414062L0.941406 1.1875C0.484375 1.60938 0.484375 2.3125 0.941406 2.73438L4.45703 6.25L0.941406 9.80078C0.484375 10.2227 0.484375 10.9258 0.941406 11.3477L1.71484 12.1211C2.13672 12.5781 2.83984 12.5781 3.26172 12.1211L6.8125 8.60547L10.3281 12.1211C10.75 12.5781 11.4531 12.5781 11.875 12.1211L12.6484 11.3477C13.1055 10.9258 13.1055 10.2227 12.6484 9.80078L9.13281 6.25Z"/>
                                                                    </svg>
                                                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box ">
                                <div class="flex-box rate-valu">
                                    <h5>
                                        کیفیت:
                                    </h5>
                                    <form class="rating-form " action="#" method="post" name="rating-movie">
                                        <fieldset class="form-group2 rating-star">

                                            <legend class="form-legend">Rating:</legend>

                                            <div class="form-item">

                                                <input id="rating-5" name="rating" type="radio" value="5"/>
                                                <label for="rating-5" data-value="5">
        <span class="rating-star">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star"></i>
        </span>
                                                </label>
                                                <input id="rating-4" name="rating" type="radio" value="4"/>
                                                <label for="rating-4" data-value="4">
        <span class="rating-star">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star"></i>
        </span>
                                                </label>
                                                <input id="rating-3" name="rating" type="radio" value="3"/>
                                                <label for="rating-3" data-value="3">
        <span class="rating-star">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star"></i>
        </span>
                                                </label>
                                                <input id="rating-2" name="rating" type="radio" value="2"/>
                                                <label for="rating-2" data-value="2">
        <span class="rating-star">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star"></i>
        </span>
                                                </label>
                                                <input id="rating-1" name="rating" type="radio" value="1"/>
                                                <label for="rating-1" data-value="1">
        <span class="rating-star">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star"></i>
        </span>
                                                </label>


                                            </div>

                                        </fieldset>
                                    </form>
                                </div>


                            </div>
                        </div>


                    </div>
                    <div class=" row">
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box ">
                                <div class="row">
                                    <div class="space  col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div id="legal-person-input" class="form-group">
                                            <input type="radio" name="radiogroup" id="checkbox1" value="1">
                                            <label for="checkbox1">خرید این محصول را به دیگران <span class="green">پیشنهاد می‌کنم</span></label>
                                        </div>
                                    </div>
                                    <div class="space col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="radio" name="radiogroup" id="checkbox2" value="0">
                                            <label id="dis" for="checkbox2">خرید این محصول را به دیگران <span
                                                        class="red">پیشنهاد نمی‌کنم</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" row">
                        <div class="space col-lg-12 col-md-12 col-sm-12">
                            <div class="white-box ">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="filter-title" class="flex-box filter-title">
                                            <div class="dot flex-box">
                                                <span></span>
                                            </div>
                                            <h2>
                                                تصاویر و ویدیو محصول
                                            </h2>

                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="image-row add-image">
                                            <div class="float-right imageBoxMain">

                                            </div>

                                            <div class="upload-row image-box">
                                                <input type="file" id="upload-file" hidden multiple>
                                                <label class="upload flex-box" for="upload-file">
                                                    <img src="{{ asset('client/assets/icon/green-pluse.svg') }}">
                                                    <p>
                                                        افزودن تصویر یا ویدیو
                                                    </p>
                                                </label>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                            <span class="aline-left red" id="error" style="display: none">
                                لطفا همه موارد خواسته شده را به درستی وارد کنید
                            </span>
                            <div class="aline-left bottomBoxOfComment">
                                <a class="back">
                                    لغو ارسال دیدگاه و بازگشت به صفحه قبل
                                </a>
                                <a id="submit-massege" class="submit-filter submit-button" onclick="submitForm()">
                                    <div class="icon-item">
                                        <img src="{{ asset('client/assets/icon/filter.svg') }}">

                                    </div>
                                    ارسال دیدگاه
                                </a>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <form method="POST" action="{{route("comment_submit")}}" id="formHiddenComment">
        @csrf
        <input type="text" name="redItems" id="redItems" hidden/>
        <input type="text" name="greenItems" id="greenItems" hidden/>
        <input type="text" name="ratingNo" id="ratingNo" hidden/>
        <input type="text" name="offer" id="offer" hidden/>
        <input type="file" name="fileInput" id="fileInput" hidden multiple/>
    </form>


@endsection

@section('optional_footer')

    <style>
        .imageBoxCard{
            position: relative;
        }

        .imageBoxCardHover{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0,0,0,.5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            opacity: 0;
            transition: all .5s ease;
        }

        .imageBoxCardHover:hover{
            opacity: 1;
            /*color:red;*/
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
            integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
            crossorigin="anonymous"></script>

    <script>

        var fd = new FormData();
        var imageArray = [];
        var imageIndex = -1;
        var product_id = "{{ $product->id}}";
        var redirectLink = "{{ route('single_product' , $product->slug)  }}";

        function readURLImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                console.log(input.files[0])

                reader.onload = function (e) {
                    if(input.files[0].name.indexOf(".mp4") != -1 || input.files[0].name.indexOf(".avi") != -1 || input.files[0].name.indexOf(".mov") != -1){
                        $('.imageBoxMain').append(`
                        <div class="image-box imageBoxCard" data-name="${input.files[0].name}">
                            <div class="imageBoxCardHover">
                                <i class="fa fa-times"></i>
                            </div>
                            <img src="{{asset('client/assets/photo/mp4Icon.jpg')}}">
                        </div>
                    `);
                    }else{

                        $('.imageBoxMain').append(`
                        <div class="image-box imageBoxCard" data-id="${imageIndex}" data-name="${input.files[0].name}">
                            <div class="imageBoxCardHover">
                                <i class="fa fa-times"></i>
                            </div>
                            <img src="${e.target.result}">
                        </div>
                    `);
                    }


                }
                // $("#fileInput").attr("files")


                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(document).on("click",".imageBoxCardHover",function () {
            var image = $(this).parent().children("img");
            var imgIndex = $(this).parent().data("id");
            var imgName = $(this).parent().data("name");

            imageArray = imageArray.filter(function(obj) {
                return (obj.name !== imgName);
            });

            $(this).parent().remove();

        })

        function testImage() {

            console.log(fd.getAll("files[]"));
        }


        $("#upload-file").change(function () {
            readURLImage(this);
            imageArray.push(this.files[0]);
            // testImage()
        })


        var template = function (text) {
            return '<div class="flex-box"><h5>' + text + ' </h5><svg class="glyphicon-remove" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.13281 6.25L12.6484 2.73438C13.1055 2.3125 13.1055 1.60938 12.6484 1.1875L11.875 0.414062C11.4531 -0.0429688 10.75 -0.0429688 10.3281 0.414062L6.8125 3.92969L3.26172 0.414062C2.83984 -0.0429688 2.13672 -0.0429688 1.71484 0.414062L0.941406 1.1875C0.484375 1.60938 0.484375 2.3125 0.941406 2.73438L4.45703 6.25L0.941406 9.80078C0.484375 10.2227 0.484375 10.9258 0.941406 11.3477L1.71484 12.1211C2.13672 12.5781 2.83984 12.5781 3.26172 12.1211L6.8125 8.60547L10.3281 12.1211C10.75 12.5781 11.4531 12.5781 11.875 12.1211L12.6484 11.3477C13.1055 10.9258 13.1055 10.2227 12.6484 9.80078L9.13281 6.25Z"/></svg></div>\n';
        };

        var main = function () {
            $('.form').submit(function () {
                var text = $('#todo').val();
                var html = template(text);
                $('.list').append(html);
                $('#todo').val("");
                return false;
            });

            $(document).on('click', '.glyphicon-star', function () {
                $(this).toggleClass('active');
            });

            $(document).on('click', '.glyphicon-remove', function () {
                $(this).parent().fadeOut();
            });
            var add = function (item) {
                var html = template(item);
                $(html).appendTo('.list');

            };
            if (annyang) {
                var command = {'add *item': add,};
            }
            ;
            annyang.addCommands(command);
            annyang.start();

        };
        $(document).ready(main);

        var template2 = function (text) {
            return '<div class="flex-box"><h5>' + text + ' </h5><svg class="glyphicon-remove" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.13281 6.25L12.6484 2.73438C13.1055 2.3125 13.1055 1.60938 12.6484 1.1875L11.875 0.414062C11.4531 -0.0429688 10.75 -0.0429688 10.3281 0.414062L6.8125 3.92969L3.26172 0.414062C2.83984 -0.0429688 2.13672 -0.0429688 1.71484 0.414062L0.941406 1.1875C0.484375 1.60938 0.484375 2.3125 0.941406 2.73438L4.45703 6.25L0.941406 9.80078C0.484375 10.2227 0.484375 10.9258 0.941406 11.3477L1.71484 12.1211C2.13672 12.5781 2.83984 12.5781 3.26172 12.1211L6.8125 8.60547L10.3281 12.1211C10.75 12.5781 11.4531 12.5781 11.875 12.1211L12.6484 11.3477C13.1055 10.9258 13.1055 10.2227 12.6484 9.80078L9.13281 6.25Z"/></svg></div>\n';
        };

        function GetItemsFromList() {
            var greenItem = $(".list .flex-box");
            var redItem = $(".list2 .flex-box");
            for (var i = 0; i < redItem.length; i++) {

                var textOfItem = $(redItem).eq(i).children("h5").text();

                $("#redItems").val($("#redItems").val() + "-" + textOfItem);

            }
            for (var i = 0; i < greenItem.length; i++) {

                var textOfItem = $(greenItem).eq(i).children("h5").text();

                $("#greenItems").val($("#greenItems").val() + "-" + textOfItem);

            }

        }

        $("input[name=rating]").change(function () {
            $("#ratingNo").val($(this).val());
        })

        $("input[name=radiogroup]").change(function () {
            $("#offer").val($(this).val());
        })

        var main2 = function () {
            $('.form2').submit(function () {
                var text = $('#todo2').val();
                var html = template2(text);
                $('.list2').append(html);
                $('#todo2').val("");
                return false;
            });

            $(document).on('click', '.glyphicon-star', function () {
                $(this).toggleClass('active');
            });

            $(document).on('click', '.glyphicon-remove', function () {
                $(this).parent().fadeOut();
            });
            var add2 = function (item) {
                var html = template2(item);
                $(html).appendTo('.list');

            };
            if (annyang) {
                var command = {'add *item': add2,};
            }
            ;
            annyang.addCommands(command);
            annyang.start();

        };

        $(document).ready(main2);

        function submitForm() {
            GetItemsFromList();
            var _token = $("input[name=_token]").val();
            var textComment = $(".textComment").val();
            var redItems = $("#redItems").val();
            var greenItems = $("#greenItems").val();
            var ratingNo = $("#ratingNo").val();
            var offer = $("#offer").val();


            fd.append("_token", _token);
            fd.append("textComment", textComment);
            fd.append("redItems", redItems);
            fd.append("greenItems", greenItems);
            fd.append("ratingNo", ratingNo);
            fd.append("offer", offer); //1 means
            fd.append("product_id", product_id);
            console.log("object");

            for (var i = 0; i < imageArray.length; i++) {
                fd.append("files[]", imageArray[i]);
            }


            axios({
                method: 'POST',
                url: "{{route('comment_submit')}}",
                header: {
                    "Content-Type": "multipart/form-data"
                },
                data: fd,
            }).then(function (response) {
                // handle success
                // console.log(response);
                window.location.href = redirectLink;

            }).catch(function (err) {
                $('#error').show()
            });


            // $.ajax({
            //     url:"{{route('comment_submit')}}",
            //     method:"post",
            //     data:fd,
            // }).done(function (res) {
            //     console.log("res")

            // }).fail(function () {
            //     console.log("err")

            // })

            // document.getElementById('formHiddenComment').submit()
        }
    </script>

@endsection
