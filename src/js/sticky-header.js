/**
 * Sticky main header and sticky subnav
 *
 */

( function( $ ) {

    var offset = $( "#wrapper-navbar" ).offset();
    var submenuOffset = $( "#centered-submenu" ).offset();

    checkOffset();

    $(window).scroll(function() {
        checkOffset();
    });

    function checkOffset() {
        //main sticky header
        if ( $(document).scrollTop() > offset.top){
            $('#wrapper-navbar').addClass('fixed-top');
            $('.nav-spacer').show(0);
        } else {
            $('#wrapper-navbar').removeClass('fixed-top');
            $('.nav-spacer').hide(0);
        }


        //only make the subheader sticky if it exists and is not being
        //used for blog posts page
        if (submenuOffset &&  !$( "#centered-submenu" ).hasClass('blog-subheader')) {
            //submenu sticky header
            submenuScroll = $(window).scrollTop() + $("#wrapper-navbar").height() + $("#centered-submenu").height();
            if ( submenuScroll > submenuOffset.top){
                $('#centered-submenu').addClass('fixed-top');
                $('.submenu-spacer').show(0);
            } else {
                $('#centered-submenu').removeClass('fixed-top');
                $('.submenu-spacer').hide(0);
            }
        }

    }

} )( jQuery );
