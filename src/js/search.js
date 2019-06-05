/**
 * Handles search behavior in nav (initially collapsed, then expand on click)
 *
 * */

(function ($) {

    var openSearch = false;

    console.log('curr width is bigger than 992');
    $("button#searchsubmit").click(function (e) {
        //calculate width of window when submit is clicked
        var currWidth = Math.max(
            document.documentElement.clientWidth,
            window.innerWidth || 0
        ) //grab width, and only do collapse/uncollapse on windows at large size or bigger

        var inputVal = $("input#vera-search").val().trim();

        //this 992 value comes from bootstrap grig lg size
        if (currWidth > 992) {
            if (!openSearch) { //input is collapsed
                console.log('open search');
                e.preventDefault();
                $("input#vera-search").removeClass("hide-search-input");
                $("button#searchsubmit").removeClass("no-border");
                openSearch = true;
            } else if (inputVal.length === 0) { //input is open but no search
                e.preventDefault();
                $("input#vera-search").addClass("hide-search-input");
                $("button#searchsubmit").addClass("no-border");
                openSearch = false;
            } else {
                $("form#searchform").submit();
            }
        } else {
            $("form#searchform").submit();
        }

    });

})(jQuery);