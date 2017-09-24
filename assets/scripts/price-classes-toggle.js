$(document).ready(function() {
    {
        var i;
        switch (window.location.hash) {
            case '#basic':
                i = 0;
                break;
            case '#premium':
                i = 2;
                break;
            case '#standard':
            default:
                i = 1;
                break;
        }
        $('#price-class-' + i).removeClass('is-hidden');
        $('#price-class-nav>li:nth-child(' + (i+1) + ')').addClass('is-active');
    }

    $(window).on('hashchange', function() {
        var i;
        switch (window.location.hash) {
            case '#basic':
                i = 0;
                break;
            case '#premium':
                i = 2;
                break;
            case '#standard':
            default:
                i = 1;
                break;
        }
        $('#price-class-nav>li').each(function(j) {
            if (j != i) {
                $(this).removeClass('is-active');
                $('#price-class-' + j).addClass('is-hidden');
            }
        });
        $('#price-class-nav>li:nth-child(' + (i+1) + ')').addClass('is-active');
        $('#price-class-' + i).removeClass('is-hidden');
    });
});