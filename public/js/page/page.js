;(function($)
{
  'use strict';

  $(document).ready(function()
  {
    var
      $pageContent = $('#page-content'),
      $pageForm = $('#page-form'),
      $remover = $('#link-remover-pagina'),
      $preview = $('#preview'),
      $content = $('#content');

    $content.on('keyup', function()
    {
      $preview.html(markdown.toHTML(this.value));
    });

    if($content.length)
    {
      $preview.html(markdown.toHTML($content.val()));
    }

    $pageForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

    /**
    * CMD + Enter para salvar
    */
    $content.on('keydown', function(event)
    {
      if(event.keyCode == 13 && event.metaKey)
      {
        $pageForm.submit();
      }
    });

    $remover.on('click', function(event)
    {
      event.preventDefault();

      var confirm = window.confirm('Tem certeza que deseja remover a página?');

      if(confirm)
      {
        window.location = $(this).attr('href');
      }
    });

    if($pageContent.length)
    {
      $pageContent.html(markdown.toHTML($pageContent.html()));
      $pageContent.removeClass('hide');
    }

  });
})(window.jQuery);