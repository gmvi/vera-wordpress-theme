(function ($) {
    'use strict';
    $(function () {
        // add toggle indicator to all days with events
        var caret = '<i class="fa fa-angle-down side-caret p-2"></i>';
        $('li.mc-events strong.event-date button').append(caret);

        // show all events except the previous days
        $('li.mc-events').children().show();
        var pastDays = $('li.past-date');
        pastDays.find( '.vevent' ).toggle();
        pastDays.find( 'strong.event-date button i.side-caret' ).toggleClass('down');

        // set date switcher to user bootstrap classes
        // $('div.my-calendar-date-switcher form').addClass('form-inline');
        // $('div.my-calendar-date-switcher form div select').addClass('form-control');
        // var submitBtn = $('div.my-calendar-date-switcher form div input[type="submit"]');
        // submitBtn.addClass('btn btn-primary');
        // submitBtn.removeClass('button');

        //move categories to header
        $('.category-key').insertBefore('ul.mc-list');
        $(document).on('click', '.my-calendar-nav ul li a', function(e) {
            $('li.mc-events').children().show();
        });
        // toggle event day
        $(document).on( 'click', '.event-date button',
            function (e) {
                e.preventDefault();
                $( this ).closest( '.mc-events' ).find( '.vevent' ).toggle();
                if ( $( this ).is( 'i.side-caret' ) ) {
                    $( this ).toggleClass( 'down' );
                } else {
                    $( this ).find( 'i.side-caret' ).toggleClass('down');
                }
                var visible = $(this).closest( '.mc-events' ).find('.vevent').is(':visible');
                if ( visible ) {
                    $(this).attr('aria-expanded', 'true');
                } else {
                    $(this).attr('aria-expanded', 'false');
                }
            });
    });
}(jQuery));