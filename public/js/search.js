;(function($)
{
  'use strict';

  $(document).ready(function(){

    var
      $searchClear = $('.search-clear'),
      $searchDo = $('.search-do'),
      $searchField = $('.search-field')
    ;

    $searchField.on('keyup', function(event)
    {
      if(event.keyCode === 13)
      {
        window.location = $(this).data('url')+'?search='+this.value;
      }
    });

    $searchDo.on('click', function()
    {
      window.location = $(this).data('url')+'?search='+$searchField.val();
    });

    $searchClear.on('click', function(event)
    {
      window.location = $(this).data('url');
    });
  });
})(window.jQuery);