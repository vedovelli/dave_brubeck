;(function($)
{
  'use strict';

  $(document).ready(function()
  {
    var $categories = $('#categories'),
        $owner = $('#owner'),
        $members = $('#members'),
        url = window.location;

    if(url.hash === '#secao')
    {
      $('#modalSection').modal('show');
    }

    $('#modalSection').on('hidden.bs.modal', function()
    {
      // TODO pensar numa maneira de zerar o #hash
    });

    if($owner.length)
    {
      $owner.select2({
        placeholder: 'Selecionar um líder para o projeto'
      });
    }

    if($categories.length)
    {
      $categories.select2({
        placeholder: 'Selecionar uma ou mais categorias'
      });
    }

    if($members.length)
    {
      $members.select2({
        placeholder: 'Selecionar um ou mais membros'
      });
    }
  });
})(window.jQuery);