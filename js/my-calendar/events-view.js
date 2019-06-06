(function ($) {
    'use strict';
    //todo: call out this function in documentation!
    $(function () {
        //var a = [ 1, 5, 1, 6, 4, 5, 2, 5, 4, 3, 1, 2, 6, 6, 3, 3, 2, 4 ];
        //
        // var unique = a.filter(function(itm, i, a) {
        //     return i == a.indexOf(itm);
        // });

        // console.log(unique);
        //fixme: if we can figure out why es6 isn't working and fix that, we could nust use the new Set object
        //var newSet = [...new Set(hiddens.map(function(x){return x.textContent}))]
        var allEventLocations = $('span.HIDDEN-CATEGORY');
        var flags = [], uniqueEventLocations = [], l = allEventLocations.length, i;
        for ( i = 0; i < l; i++ ) {
            if ( flags[allEventLocations[i].textContent] ) continue;
            flags[ allEventLocations[i].textContent ] = true;
            uniqueEventLocations.push( allEventLocations[i].textContent );
        }

        // list modifications
        if ( typeof($( '.mc-main.list' ).val()) !== 'undefined' ) {
            console.log("we're showing a list!");
            // add toggle indicator to all days with events
            var caret = '<i class="fa fa-angle-down side-caret p-2"></i>';
            $('li.mc-events strong.event-date button').append(caret);

            // show all events except the previous days
            $('li.mc-events').children().show();
            var pastDays = $('li.past-date');
            pastDays.find( '.vevent' ).toggle();
            pastDays.find( 'strong.event-date button i.side-caret' ).toggleClass('down');

            //move categories to header
            $('.category-key').insertBefore('ul.mc-list');
            $(document).on('click', '.my-calendar-nav ul li a', function(e) {
                $('li.mc-events').children().show();
            });
            // todo: need to add in category calls w/ ajax load for ltype=name&loc=Vera+Homebase+ to get location filter!!
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
        } else if ( $( '.mc-main.calendar' ) ) {
            // set date switcher to user bootstrap classes
            $('div.my-calendar-date-switcher form').addClass('form-inline');
            $('div.my-calendar-date-switcher form div select').addClass('form-control');
            if ( uniqueEventLocations.length > 0 ) {
                var urlParams = new URLSearchParams(window.location.search);
                $('<div class="location-key"><ul></ul></div>').insertAfter( $('div.category-key') );
                var listParent = $('div.location-key ul');
                uniqueEventLocations.forEach(function(loc, index) {
                    var encodedLoc = encodeURIComponent(loc);
                    // todo: review -- link right now actually triggers a refresh of the page, while categories (classes, etc) doesn't
                    //   make behavior uniform
                    var link = $('<a></a>').attr('href', '?ltype=name&loc=' + encodedLoc).addClass('').text(loc);
                    var listElem = $('<li></li>').addClass(urlParams.has('loc') ? 'current' : '').append(link);
                    listParent.append(listElem);
                });
                // only add 'All Locations' link if a specific location is selected
                if ( urlParams.has('loc') ) {
                    listParent.append( $( '<li></li>' ).append($('<a></a>').attr('href', window.location.pathname).text('All Locations')) );
                }
                console.log('path', window.location.pathname, 'window', window.location.search)
            }
            // var locationsLinks = $('<div class="location-key"></div>');
            // var $listParent = $locationsLinks.children('ul')[0];
            // uniqueEventLocations.forEach(function(loc, index) {
            //     var encodedLoc = encodeURIComponent(loc);
            //     var $url = $('<li><a href="?ltype=name&loc=' + encodedLoc + '" class="mcajax">' + loc + '</a></li>');
            //     console.log("url", $url);
            //     $listParent.append($url)
            // });
            // console.log(listParent);
            // var submitBtn = $('div.my-calendar-date-switcher form div input[type="submit"]');
        }
    });
}(jQuery));