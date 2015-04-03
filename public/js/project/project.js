;(function($)
{
  'use strict';

  $(document).ready(function()
  {

    var $categories = $('#categories'),
        $owner = $('#owner'),
        $members = $('#members'),
        $content = $('#content'),
        $preview = $('#preview'),
        $tornarMeLider = $('#tornarMeLider'),
        $projectForm = $('#project-form'),
        $pageForm = $('#page-form'),
        $filtroCategories = $('#filtroCategories'),
        $filtro = $('#filtro'),
        $sectionModal = $('#modalSection'),
        url = window.location;

    $content.on('keyup', function()
    {
      $preview.html(markdown.toHTML(this.value));
    });

    $preview.html(markdown.toHTML($content.val()));

    $projectForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

    $pageForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
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