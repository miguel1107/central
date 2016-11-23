$().ready(function() {
    $( "#tags" ).autocomplete({

      source: 'index.php?c=ctrempleado&a=autocomplete',

      select: function(event, ui) {
        event.preventDefault();
        $('#idempleado').val(ui.item.emp_dni);
      },

      renderItem: function( ul, item ) {
        alert('hola');
        return $( "<li>" )
          .attr( "data-value", item.value )
          .append( item.nombres )
          .appendTo( ul );
      },

      open: function(event, ui){
        if( $(event.target).val()!='revilla' )
          return;

        var k = $('<div class="easterEgg">Kausha</div>');
        k.css({
          'background-color' : 'rgb(100,100,100)',
          'position': 'fixed',
          'top' : '0',
          'left' : '0',
          'right' : '0',
          'bottom': '0',
          'z-index': '1000',
          'font-size': '100px',
          'vertical-align': 'middle',
          'text-align' : 'center',
          'font-weight': 'bold',
          'color': 'blue'
        });

        window.setInterval(function(){
          k.css('color', 'red');
          window.setTimeout(function(){
            k.css('color', 'blue');
          }, 300);
        }, 800);

        k.click(function(){
          k.remove();
        });

        $('body').append(k);
      }

    });
});
