(function($) {
$('document').ready(function() {
    
    /* Jump Top Button
    ======================== */
    var winHeight = $( window ).height();
    
    $( document ).scroll(function() {
        if ( $( document ).scrollTop() > winHeight ) {
            $('body').addClass( 'scrolled' );
        } else {
            $('body').removeClass( 'scrolled' );
        }
    });

    $('.mobile-jump-top').bind('click', function(e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: $( 'body' ).offset().top
        });
    });

});
})(jQuery)