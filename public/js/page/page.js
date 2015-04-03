;(function($)
{
  'use strict';

  $(document).ready(function()
  {
    var $pageContent = $('#page-content');

    $pageContent.html(markdown.toHTML($pageContent.html()));
    $pageContent.removeClass('hide');
  });
})(window.jQuery);