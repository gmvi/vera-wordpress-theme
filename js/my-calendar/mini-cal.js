(function ($) {
    'use strict';
    $(function () {
        $( ".mini .has-events" ).children().not( ".trigger, .mc-date, .event-date" ).hide();
        $( document ).on( "click", ".mini .has-events .trigger", function (e) {
            $('div.calendar-events').hide();
            e.preventDefault();
            var current_date = $(this).parent().children();
            current_date.not(".trigger").addClass("active-af").toggle().attr( "tabindex", "-1" ).focus();
            $( '.mini .has-events' ).children( '.trigger' ).removeClass( 'active-toggle' );
            $( '.mini .has-events' ).children().not( '.trigger, .mc-date, .event-date' ).not( current_date ).hide();
            $( this ).addClass( 'active-toggle' );
            var actived = $(this);
            $( document ).one('click', function (event) {
                if ( !$(event.target).closest('div.calendar-events').length || $(event.target).hasClass('dashicons-dismiss')) {
                    e.preventDefault();
                    actived.removeClass('active-toggle');
                    $('.active-af').toggle();
                }
            })
        } );
        // $( document ).on( "click", ".mini-event .close", function (e) {
        // 	e.preventDefault();
        // 	$(this).closest( '.mini .has-events' ).children( '.trigger' ).removeClass( 'active-toggle' );
        // 	$(this).closest( 'div.calendar-events' ).toggle();
        // } );
    });
}(jQuery));