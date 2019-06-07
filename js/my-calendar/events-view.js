(function ($) {
    'use strict';
    //todo: call out this function in documentation!
    $(function () {
        function getUniqueEventLocations() {
            var allEventLocations = $('span.HIDDEN-CATEGORY');
            //fixme: if we can figure out why es6 isn't working and fix that, we could nust use the new Set object
            var flags = [], uniqueEventLocations = [], l = allEventLocations.length, i;
            for ( i = 0; i < l; i++ ) {
                if ( flags[allEventLocations[i].textContent] ) continue;
                flags[ allEventLocations[i].textContent ] = true;
                uniqueEventLocations.push( allEventLocations[i].textContent );
            }
            return uniqueEventLocations;
        }

        function createLocationFilterList(uniqueEventLocations) {
            // delete any old location key
            $('div.location-key').remove();
            // with grid view, we are using the hash attribute for the search string instead of search string
            //   so that the page doesn't trigger a reload
            var searchStr = window.location.search ? window.location.search : window.location.hash.slice(1);
            var urlParams = new URLSearchParams(searchStr);
            $('<div class="location-key"><ul></ul></div>').insertAfter( $('div.category-key') );
            var listParent = $('div.location-key ul');
            // build a link for every unique location with a url that allows filtering the calendar on that location,
            // but preserves the other active filters (e.g. category)
            uniqueEventLocations.forEach(function(loc, i) {
                if (loc) {
                    var encodedLoc = encodeURIComponent(loc);
                    var newUrlParams = new URLSearchParams('?ltype=name&loc=' + encodedLoc);
                    // Add old url query args that aren't related to the location
                    urlParams.forEach(function(value, key) {
                        if (!newUrlParams.has(key)) { newUrlParams.set(key, value) }
                    });
                    var link = $('<a></a>').attr('href', window.location.origin + window.location.pathname + '?' + newUrlParams.toString()).addClass('mcajax').text(loc);
                    var listElem = $('<li></li>').addClass(urlParams.has('loc') ? 'current' : '').append(link);
                    listParent.append(listElem);
                }
            });
            // only add 'All Locations' link if a specific location is selected to mimic native my calendar behavior
            if ( urlParams.has('loc') ) {
                // todo: the text for the all locations button could be a field somewhere
                listParent.append( $( '<li></li>' )
                    .append( $('<a></a>').addClass('mcajax').attr('href', window.location.origin + window.location.pathname).text('All Locations')) );
            }
        }

        $(document).on('list-custom:reload', function (event) {
            //move categories to header
            $('.category-key').insertBefore('ul.mc-list');
            // build location filter links
            var uniqueEventLocations = getUniqueEventLocations();
            createLocationFilterList(uniqueEventLocations);
            // add toggle indicator to all days with events
            var caret = '<i class="fa fa-angle-down side-caret p-2"></i>';
            $('li.mc-events strong.event-date button').append(caret);
            // show all events except the previous days
            $('li.mc-events').children().show();
            var pastDays = $('li.past-date');
            pastDays.find( '.vevent' ).toggle();
            pastDays.find( 'strong.event-date button i.side-caret' ).toggleClass('down');

        });
        $(document).on("list-custom:load-list-expansions", function(event) {
            console.log("you've triggered load-list-expansions");
            $(document).on('click', '.my-calendar-nav ul li a', function(e) {
                $('li.mc-events').children().show();
            });
            // expand all events for clicked day
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
                }
            );
        });
        $(document).on('grid-custom:reload',  function( event ) {
            var uniqueEventLocations = getUniqueEventLocations();
            // set date switcher to user bootstrap classes
            $('div.my-calendar-date-switcher form').addClass('form-inline');
            $('div.my-calendar-date-switcher form div select').addClass('form-control');
            createLocationFilterList(uniqueEventLocations)
        });
        if ( $( '.mc-main.list' ).length ) {
            $(document).trigger( "list-custom:reload" );
            $(document).trigger("list-custom:load-list-expansions");
        } else if ( $( '.mc-main.calendar' ).length ) {
            $(document).trigger( "grid-custom:reload" );
        }
    });
}(jQuery));