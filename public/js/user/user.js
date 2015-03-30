;(function($)
{
  'use strict';

  $(document).ready(function(){

    var $userForm = $('.user-form');

    $userForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

  });

})(window.jQuery);