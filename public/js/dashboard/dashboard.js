;(function($)
{
  'use strict';

  $(document).ready(function(){

    var $buscaRapida = $('.dave-busca-rapida').find('input[type="text"]');

    var localEmail = localStorage.getItem('dave.user.email');

    if(localEmail === null)
    {
      $.getJSON('/api/usuario-logado', function(data)
      {
        localStorage.setItem('dave.user.email', data.email);
      });
    }

    $buscaRapida.select2({
      minimumInputLength: 3,
      ajax: {
        url: "/api/projetos",
        dataType: 'json',
        quietMillis: 250,
        data: function (term) {
          return { search: term };
        },
        results: function (data, page) {
          return { results: data };
        }
      },
      formatResult: function (project) {
        var markup = '<h4 class="text-left"><i class="fa fa-clipboard"></i> '+project.text+'</h4>';
        return markup;
      },
      formatSelection: function (project) {
        return project.name;
      }
    }).on('change', function()
    {
      window.location = '/projetos/'+this.value+'/detalhes';
    });
  });
})(window.jQuery);