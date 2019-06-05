/**
 * Handles search behavior in nav (initially collapsed, then expand on click)
 *
* */

( function( $ ) {

    var openSearch = false;


    $( "form#searchform" ).on('submit', function(e) {
        var inputVal = $( "input#vera-search" ).val();
        


        if (!openSearch) {
            e.preventDefault();
            $( "input#vera-search" ).removeClass("d-none");
            $( "button#searchsubmit" ).removeClass("border-0");
            openSearch = true;
        } else {
            console.log('about to submit form');
            $( "form#searchform" ).submit();
        }
    });

} )( jQuery );