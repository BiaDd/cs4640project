// Author: Matthew Morelli
// This javascript is applied to all pages containing the navigation bar
// adds slight interactivity that helps with usability. Top nav links 

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