window.ultrazonica={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-detalle").text();
    }
    self.data={
      materiales :[]
    };
    self.render();
  },

  llenatabla: function (id) {
    var self=this;
    var options={
      type : 'post',
      url : 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleRecion',
      data: {
        'id' : id
      },
    };

    $.ajax(options)
    .done(function(data) {
      var json=data;
      var parsed = JSON.parse(json);
      var arr = [];
      for(var x in parsed){
        arr.push(parsed[x]);
      }
      for (var i = 0; i < arr.length; i++) {
        var m={
          estado :'false',
          tipo : arr[i].tipo_ingreso,
          descripcion : arr[i].descripcion,
          cantidad : arr[i].cantidad_material
        };
        self.data.materiales.push(m);
      }
      self.render();
    })
    .fail(function(xhr) {
      alert('Hubo un error al guardar :(');
      console.log(xhr.responseText);
    })
    .always(function() {
      //Se ejecuta en ambos casos después de la respuesta
    });
  },

  render: function(){
    var self = this;
    $('#detalleIngMaterial').empty();
    self.data.materiales.forEach(function(el, i){
      self.renderDetalle(i, el).appendTo('#detalleIngMaterial');
    });
  },

  renderDetalle: function (index,elemento) {
    var self=this;
    var $m=$(self.tmpl);
    $m.find('.tipo').text(self.data.materiales[index].tipo);
    $m.find('.descripcion').text(self.data.materiales[index].descripcion);
    $m.find('.cantidad').text(self.data.materiales[index].cantidad);
    return $m;
  },

  restart : function(){
		var self = this;
    self.init();
  }

};
