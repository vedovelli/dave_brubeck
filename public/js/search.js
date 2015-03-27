;(function($)
{
  'use strict';

  $(document).ready(function(){

    var $categoryForm = $('.category-form'),
        $searchClear = $('.search-clear'),
        $searchDo = $('.search-do'),
        $searchField = $('.search-field');

    $categoryForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

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