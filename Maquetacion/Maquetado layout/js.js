// This function will be executed when the user scrolls the page.
$(window).scroll(function(e) {
    // Get the position of the location where the scroller starts.
    var scroller_anchor = $(".scroller_anchor").offset().top;
    
    // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top 
    if ($(this).scrollTop() >= scroller_anchor && $('#scroller').css('position') != 'fixed') 
    {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
        $('#scroller').removeClass("cat-position");
        $('#scroller').addClass("fixed-top cat-position-2");

        $('#scroller2').css({
            'position': 'fixed',
            'top': '38%'
        });
        $('#productos').addClass("offset-md-4");
        $('#productos').removeClass("offset-md-1");
    } 
    else if ($(this).scrollTop() < scroller_anchor && $('#scroller').css('position') != 'relative') 
    {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.
        
        // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.
        $('.scroller_anchor').css('height', '0px');
        
        // Cambio a su posicion original.
        $('#scroller').addClass("cat-position");
        $('#scroller').removeClass("fixed-top cat-position-2");
        $('#scroller2').css({
            'position': 'relative'
        });
        $('#productos').removeClass("offset-md-4");
        $('#productos').addClass("offset-md-1");
    }
});