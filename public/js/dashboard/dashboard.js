;(function($)
{
  'use strict';

  $(document).ready(function(){

    var $buscaRapida = $('.dave-busca-rapida').find('input[type="text"]');

    // por enquanto funcionando com busca de categorias. Aguardando funcionalidade de projetos ficar pronta.
    $buscaRapida.select2({
      minimumInputLength: 3,
      ajax: {
        url: "/api/projetos",
        dataType: 'json',
        quietMillis: 250,
        data: function (term) {
          return {
              search: term
          };
        },
        results: function (data, page) {
            return { results: data };
        }
      },
      formatResult: function (project) {
        var markup = '<h4 class="text-left"><i class="fa fa-clipboard"></i> '+project.name+'</h4>';
        return markup;
      },
      formatSelection: function (project) {
        return project.name;
      }
    }).on('change', function()
    {
      window.location = '/projetos/'+this.value;
    });
  });
})(window.jQuery);