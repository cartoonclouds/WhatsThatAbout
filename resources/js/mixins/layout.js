(function($) {
    'use strict';

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $('#top-nav #desktop-block a').each(function() {
        if (this.href === path) {
            $(this).addClass('text-white bg-gray-900');
            $(this).removeClass('text-gray-300 hover:text-white hover:bg-gray-700');
        }
    });

    // Toggle the side navigation
    $(document).on('click', '#sidebarToggle', function(e) {
        e.preventDefault();
        $('body').toggleClass('sb-sidenav-toggled');
    });
})(jQuery);
