/**
 * Handles pagination through past gallery shows
 *
 */

( function( $ ) {
    var currentItem = 0;
    var galleryItems = $( ".past-gallery-item" );
    var totalItems = galleryItems.length;

    loadItem();

    $( "button#prev-gallery-item" ).click(function() {
        if (currentItem === 0)
            return;

        currentItem -= 1;
        loadItem('prev');
    });

    $( "button#next-gallery-item" ).click(function() {
        if (currentItem === totalItems - 1)
            return;

        currentItem += 1;
        loadItem('next');
    });

    function loadItem(direction) {
        var displayIndex = currentItem + 1;
        var optionalPad = '';
        if (displayIndex < 10) {
            optionalPad = '0';
        }

        $ ( "span.gallery-index" ).text(optionalPad + displayIndex);

        if (currentItem === 0) {
            $( "button#prev-gallery-item" ).prop("disabled", true);
            $( "button#next-gallery-item" ).prop("disabled", false);
        } else if (currentItem === totalItems - 1) {
            $( "button#prev-gallery-item" ).prop("disabled", false);
            $( "button#next-gallery-item" ).prop("disabled", true);
        } else {
            $( "button#prev-gallery-item" ).prop("disabled", false);
            $( "button#next-gallery-item" ).prop("disabled", false);
        }

        if (direction === 'next') {
            galleryItems.eq(currentItem - 1).removeClass("d-block").addClass("d-none");
        } else if (direction === 'prev') {
            galleryItems.eq(currentItem + 1).removeClass("d-block").addClass("d-none");
        }

        galleryItems.eq(currentItem).removeClass("d-none").addClass("d-block");
    }

} )( jQuery );
