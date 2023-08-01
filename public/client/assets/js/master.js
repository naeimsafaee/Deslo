$(function() {

    transition_timeout = 40;

    $('.title_items').click(function() {

        current = $(this).next(".main-list").find('.main-list-item');

        $(this).toggleClass('active');
        current.toggleClass('visible');

        if ($(this).hasClass('active')) {
            for( i = 0; i <= current.length; i++ ) {
                $(current[i]).css('transition-delay', transition_timeout * i + 'ms');
            }
        }
        else {
            for( i = current.length, j = -1; i >= 0; i--, j++) {
                $(current[i]).css('transition-delay', transition_timeout * j + 'ms');
            }
        }

    });
    $('.main-list-item').click(function() {

        current = $(this).find('.inner-list li');

        $(this).toggleClass('active');
        current.toggleClass('visible');

        if ($(this).hasClass('active')) {
            for( i = 0; i <= current.length; i++ ) {
                $(current[i]).css('transition-delay', transition_timeout * i + 'ms');
            }

        }
        else {
            for( i = current.length, j = -1; i >= 0; i--, j++) {
                $(current[i]).css('transition-delay', transition_timeout * j + 'ms');
            }

        }

    });
});

$('.mobile-menu').click(function() {

    $('.filter').css("transform", "translateX(0%)")
    $('.overlay2').fadeIn()


});
$('.overlay2').click(function() {
    $('.filter').css("transform", "translateX(100%)")
    $('.overlay2').fadeOut(100)

});

$('.closemenu').click(function() {

    $('.filter').css("transform", "translateX(100%)")
    $('.overlay2').fadeOut(100)

});

$(".mobile-menu").click(function(e){
    $('.filter').css("transform", "translateX(0%)")
    e.stopPropagation();

});
// ----------------------------search-box
$('.search-icon').click( function(){
    $('body').addClass('search-active');
    $('#searchbox').focus();
    $('#search').addClass("active");
});

$('.close-btn').click( function(){
    $('body').removeClass('search-active');
    $('#search').removeClass("active");
});
// -------------------------
$(".filter").click(function(e){
    e.stopPropagation();

});
$(document).click(function(){
    $('.filter').css("transform", "translateX(100%)")

});




$(document).ready(function(){
    $('.search-dropdown').click(function(){
        $('.dropdown-menu').toggleClass('active');
    });
});

var items = document.querySelectorAll(".header-item");
var ind = document.querySelector(".indicator");
function handleIndicator(el) {
    ind.style.width = el.offsetWidth + "px";
    ind.style.left = el.offsetLeft + "px";
}
items.forEach(function (item, index) {
    item.addEventListener("mousemove", function (e) {
        handleIndicator(e.target);
    });
});
// -----tabs
// jQuery.
$(function() {
    // Reference the tab links.
    const tabLinks = $('#tab-links li a');

    // Handle link clicks.
    tabLinks.click(function(event) {
        var $this = $(this);

        // Prevent default click behaviour.
        event.preventDefault();

        // Remove the active class from the active link and section.
        $('#tab-links a.active, section.active').removeClass('active');

        // Add the active class to the current link and corresponding section.
        $this.addClass('active');
        $($this.attr('href')).addClass('active');
    });
});
// ------account
$(function() {
        //----- OPEN
    const $menu = $('#popup2');
    $(document).mouseup(e => {
        if (!$menu.is(e.target) // if the target of the click isn't the container...
            && $menu.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $menu.fadeOut(150);
            $('.overlay').fadeOut(150);
        }

    });

    $('#popup-open2').on('click', () => {
        $menu.fadeIn(150);
        $(".overlay").fadeIn(150);
    });

    const $menu1 = $('#popup1');
    $(document).mouseup(e => {
        if (!$menu1.is(e.target) // if the target of the click isn't the container...
            && $menu1.has(e.target).length === 0   ) // ... nor a descendant of the container
        {
            $menu1.fadeOut(150);
        }

    });

    $('#popup-open1').on('click', () => {
        $menu1.fadeIn(150);
        $(".overlay").fadeIn(150);
    });

    //----- CLOSE
    $('.overlay').on('click', function(e)  {
        $('.profile-box').fadeOut(150);
        $('.overlay').fadeOut(150);

        e.preventDefault();
    });
});
// -------------------

$(document).ready(function() {
    var prevScrollTop = $(window).scrollTop()

    $(window).on('scroll', function(e) {
        // Variable declaration for search container
        var $src = $('.bottom-header');
        var currentScrollTop = $(this).scrollTop()
        if($(window).width() > 1020)
        {
            if (currentScrollTop >= prevScrollTop && currentScrollTop > 44  ) {

                $src.slideUp();

            }
            else {

                $src.slideDown();

            }
        } else {
            // change functionality for larger screens
        }


        prevScrollTop = currentScrollTop
    });

});

// ----
$(document).ready(function (){
    $("#nav-item").hover(function(){
            $(".fade-page").fadeIn(150);
            $(".menu-container").fadeIn(150);
            let menu = $('.menu-item').first();
            if (!menu.hasClass('active')) {
                menu.addClass('active')
                menu.find('.submenu').addClass('active')
            }
        }
        ,function(){
            $(".fade-page").fadeOut(150);
            $(".menu-container").fadeOut(150);

        }
    );

    $('.menu-item').hover(function () {
        $(this).addClass('active')
        $(this).find('.submenu').addClass('active')
    }, function () {
        $(this).removeClass('active')
        $(this).find('.submenu').removeClass('active')
    })
})

// ------------------

$(function() {
    $('.phonecell').click(function() {
        if ($(window).width() <= 768){
            var PhoneNumber = $(".support-row h5").text();
            PhoneNumber = PhoneNumber.replace('Phone:', '');
            window.location.href = 'tel://' + PhoneNumber;
        }

    });
});

$('.color-picker').on('click', function(){
    $(this).toggleClass('active');
});


// Set counter default to zero
var counter = 1
var counter1 = 1
var counter2 = 1
// Display total
$(".space .add-order .counter").text(counter);
$(".counter1").text(counter1);
$(".counter2").text(counter2);

// When button is clicked
$(".space .add-order .add").click(function () {

    //Add 10 to counter
    counter = counter + 1;

    // Display total
    $(".space .add-order .counter").text(counter);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});
$(".add1").click(function () {

    //Add 10 to counter
    counter1 = counter1 + 1;

    // Display total
    $(".counter1").text(counter1);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});
$(".add2").click(function () {

    //Add 10 to counter
    counter2 = counter2 + 1;

    // Display total
    $(".counter2").text(counter2);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});

//Subtract

$(".space .add-order .remove").click(function () {
    if (counter > 1) {
        counter = counter - 1;

    }

    $(".space .add-order .counter").text(counter);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});
$(".remove1").click(function () {
    if (counter1 > 1) {
        counter1 = counter1 - 1;

    }

    $(".counter1").text(counter1);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});

$(".remove2").click(function () {
    if (counter2 > 1) {
        counter2 = counter2 - 1;

    }

    $(".counter2").text(counter2);
    function walkNode(node) {
        if (node.nodeType == 3) {
            // Do your replacement here
            node.data = node.data.replace(/\d/g, convert);
        }

        // Also replace text in child nodes
        for (var i = 0; i < node.childNodes.length; i++) {
            walkNode(node.childNodes[i]);
        }
    }

    walkNode(document.getElementsByTagName('body')[0]);

    function convert(a) {
        return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
    }

});

function walkNode(node) {
    if (node.nodeType == 3) {
        // Do your replacement here
        node.data = node.data.replace(/\d/g, convert);
    }

    // Also replace text in child nodes
    for (var i = 0; i < node.childNodes.length; i++) {
        walkNode(node.childNodes[i]);
    }
}

// walkNode(document.getElementsByTagName('body')[0]);

function convert(a) {
    return ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'][a];
}
