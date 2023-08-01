$(document).ready(function () {
    setTimeout(function () {
        $('.error-message').css("transform", "translateY(0%)")

    }, 1000);


});
$('.error-message').click(function () {
        $('.error-message').css("transform", "translateY(-250%)")

});