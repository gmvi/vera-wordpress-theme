/**
 * Handles search behavior in nav (initially collapsed, then expand on click)
 *
* */

( function( $ ) {

    var openSearch = false;


    $( "form#searchform" ).on('submit', function(e) {
        if (!openSearch) {
            e.preventDefault();
            $( "input#vera-search" ).removeClass("d-none");
        } else {
            console.log('about to submit form');
            $( "form#searchform" ).submit();
        }
    });

} )( jQuery );