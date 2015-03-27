;(function($)
{
  'use strict';
  $(document).ready(function(){

    var $buscaRapida = $('.dave-busca-rapida').find('input[type="text"]');

    // por enquanto funcionando com busca de categorias. Aguardando funcionalidade de projetos ficar pronta.
    $buscaRapida.select2({
      minimumInputLength: 3,
      ajax: {
        url: "http://dave.app/api/categorias",
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
      formatResult: function (category) {
        var markup = '<h4 class="text-left"><i class="fa fa-list"></i> '+category.name+'</h4>';
        return markup;
      },
      formatSelection: function (category) {
        return category.name;
      }
    }).on('change', function()
    {
      // Buscar aqui o projeto!
    });
  });
})(window.jQuery);