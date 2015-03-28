;(function($)
{
  'use strict';
  $(document).ready(function()
  {
    var $categories = $('#categories'),
        $owner = $('#owner'),
        $members = $('#members');

    $owner.select2({
      placeholder: 'Selecionar um líder para o projeto'
    });

    $categories.select2({
      placeholder: 'Selecionar uma ou mais categorias'
    });

    $members.select2({
      placeholder: 'Selecionar um ou mais membros'
    });
  });
})(window.jQuery);