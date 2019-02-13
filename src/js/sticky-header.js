/**
 * Sticky header and subnav
 *
 */

( function( $ ) {

    var offset = $( "#wrapper-navbar" ).offset();
    checkOffset();

    $(window).scroll(function() {
        checkOffset();
    });

    function checkOffset() {
        if ( $(document).scrollTop() > offset.top){
            $('#wrapper-navbar').addClass('fixed-top');
            $('.nav-spacer').show(0);
        } else {
            $('#wrapper-navbar').removeClass('fixed-top');
            $('.nav-spacer').hide(0);
        }
    }

} )( jQuery );
