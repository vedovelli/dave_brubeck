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
        $filtroCategories = $('#filtroCategories'),
        $filtroUsers = $('#filtroUsers'),
        $filtro = $('#filtro'),
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

    $filtroCategories.on('change', function()
    {
      var select = $(this),
          url = select.data('url'),
          val = select.val();

      if(val === null)
      {
        window.location = url;
      } else {
        window.location = url +'?categories='+encodeURIComponent($(this).val());
      }

    });

    if($tornarMeLider.length)
    {
      $tornarMeLider.on('click', function(event)
      {
        event.preventDefault();
        $owner.val($(this).data('userId')).trigger('change');
      });
    }
  });
})(window.jQuery);