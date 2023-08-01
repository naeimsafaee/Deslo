
$(function() {
    // Owl Carousel
    var owl = $("#owl-carousel1");
    owl.owlCarousel({
        items: 1,
        loop: true,
        nav:false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        animateOut: "zoomIn",
        animateIn: "zoomOut",

    });


});
$(document).ready(function(){
    var owl = $('#owl-carousel2');
    owl.owlCarousel({
        loop:false,
        margin:10,
        nav:false,
        items: 1,
        dots: false,
        animateOut: "zoomIn",
        animateIn: "zoomOut",
        rewind: true,

    });

    // Custom Button
    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
    });
    $('.customPreviousBtn').click(function() {
        owl.trigger('prev.owl.carousel');
    });

    $('.client-item').click(function () {
        let index = Number(this.id.replace('client_item_', ''))
        $('#owl-carousel2').trigger('to.owl.carousel', index - 1);
            $(".play-icon").toggle();
            $(".pause-icon").toggle();
    })
    $('#owl-carousel2').on('translate.owl.carousel', function (event) {
        let index = event.item.index

        let items = $('.client-item')
        if (index >= items.length) {
            return
        }

        for (i = 0; i < items.length; i++) {
            items[i].classList.remove("active");
        }
        $('#client_item_' + (event.item.index + 1)).addClass('active')
    })

    let g = document.getElementsByClassName('client-item')[0];
    for (let i = 0, len = g.children.length; i < len; i++)
    {
        (function(index){
            g.children[i].onclick = function(){
                $('#owl-carousel2').trigger('to.owl.carousel', index)
            }
        })(i);
    }
});


