/**
 * Sticky header and subnav
 *
 */

( function( $ ) {

    var offset = $( "#wrapper-navbar" ).offset();
    var submenuOffset = $( "#centered-submenu" ).offset();

    checkOffset();

    $(window).scroll(function() {
        checkOffset();
        console.log('scrolly at', $(document).scrollTop(), 'top offset', offset, 'sub offset', submenuOffset);
    });

    function checkOffset() {
        if ( $(document).scrollTop() > offset.top){
            $('#wrapper-navbar').addClass('fixed-top');
            $('.nav-spacer').show(0);
        } else {
            $('#wrapper-navbar').removeClass('fixed-top');
            $('.nav-spacer').hide(0);
        }

        if ( $(document).scrollTop() - offset.top > submenuOffset.top){
            $('#centered-submenu').addClass('fixed-top');
            $('.submenu-spacer').show(0);
        } else {
            $('#centered-submenu').removeClass('fixed-top');
            $('.submenu-spacer').hide(0);
        }
    }

} )( jQuery );
