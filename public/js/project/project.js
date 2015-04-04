/**
* TODO - extrair daqui o que for de Page e criar o page.js
*/
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
        $filtro = $('#filtro'),
        $description = $('#description'),
        $sectionModal = $('#modalSection'),
        url = window.location;

    $projectForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

    /**
    * CMD + Enter para salvar
    */
    $description.on('keydown', function(event)
    {
      if(event.keyCode == 13 && event.metaKey)
      {
        $projectForm.submit();
      }
    });

    $sectionModal.on('shown.bs.modal', function()
    {
      $(this).find('#section').focus();
    });

    $sectionModal.on('hidden.bs.modal', function()
    {
      window.location.hash = '';
    });

    $(window).on('hashchange', function(event)
    {
      if(window.location.hash == '#secao')
      {
        $sectionModal.modal('show');
      }
    });

    $filtro.on('change', function()
    {
      var select = $(this),
          url = select.data('url'),
          val = select.val();

      if(val === null || val === '')
      {
        window.location = url;
      } else {
        window.location = url +'?orderby='+encodeURIComponent($(this).val());
      }
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