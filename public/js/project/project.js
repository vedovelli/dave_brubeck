;(function($)
{
  'use strict';

  $(document).ready(function()
  {
    var $categories = $('#categories'),
        $owner = $('#owner'),
        $members = $('#members'),
        $tornarMeLider = $('#tornarMeLider'),
        $projectForm = $('#project-form'),
        url = window.location;

    $projectForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

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

      $tornarMeLider.on('click', function(event)
      {
        event.preventDefault();
        $owner.val($(this).data('userId')).trigger('change');
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