$(document).ready(function() {
    $('.nav-link:not(.btn, .px-2)').mouseover(function() {
        $(this).addClass('fs-3');
    })
    $('.nav-link:not(.btn, .px-2)').mouseout(function() {
        $(this).removeClass('fs-3');
    })

    $('.accordion-button').mouseover(function() {
        $(this).addClass('text-primary');
    })
    $('.accordion-button').mouseout(function() {
        $(this).removeClass('text-primary');
    })
});