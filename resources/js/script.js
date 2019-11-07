$(function() {
    // manag post buttons
    $('.post-outer').hover(function() {
        $(this).children('.manag-post').show();
    }, function() {
        $(this).children('.manag-post').hide();
    });

    // btn comments
    $('.comment-post .comment').hover(function() {
        $(this).children('.btn-comment').show();
    }, function() {
        $(this).children('.btn-comment').hide();
    });
});
