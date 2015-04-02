;(function($)
{
    'use strict';

  $(document).ready(function()
  {
    /**
    * Dave scripts
    */
    $('[data-toggle="tooltip"]').tooltip();

    $('.dave-side').on('mouseover', function()
    {
        $(this).animate({opacity: 1, left: 0, bottom: 0});
        $('.dave-side-clique').animate({opacity: 1});
    }).on('mouseout', function()
    {
        $(this).animate({opacity: 0.5, left: -40, bottom: -20});
        $('.dave-side-clique').animate({opacity: 0});
    });

    $('.select2').select2({allowClear: true});

    /**
    * SB Admin scripts
    */
    $('#side-menu').metisMenu();

    // $(window).bind("load resize", function() {
    //     topOffset = 50;
    //     width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
    //     if (width < 768) {
    //         $('div.navbar-collapse').addClass('collapse');
    //         topOffset = 100; // 2-row-menu
    //     } else {
    //         $('div.navbar-collapse').removeClass('collapse');
    //     }

    //     height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
    //     height = height - topOffset;
    //     if (height < 1) height = 1;
    //     if (height > topOffset) {
    //         $("#page-wrapper").css("min-height", (height) + "px");
    //     }
    // });

    // var url = window.location;

    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url || url.href.indexOf(this.href) == 0;
    // }).addClass('active').parent().parent().addClass('in').parent();

    // if (element.is('li')) {
    //     element.addClass('active');
    // }

  });
})(window.jQuery);
