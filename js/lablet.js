$(document).ready(function() {

    $('.rowlink tr').click(function() {
        var href = $(this).attr("href");
        if(href) {
            window.location = href;
        }
    });
});