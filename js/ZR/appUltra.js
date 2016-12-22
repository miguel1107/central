window.ultrazonica={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-detalle").text();
    }
    if(!self.tmpl2){
      self.tmpl2 = $("#tmpl-carga").text();
    }
    self.data={
      iding :0,
      servicio:'false',
      materiales :[]
    };

    self.render();
    self.llenaCarga();
  },

  llenatabla: function (id) {
    var self=this;
    var c=0; //0->llena denuevo 1->esta lleno y id iguales 2->esta lleno id dif
    if (self.data.iding == 0) {
      self.data.iding=id;
    }else{
      if(self.data.servicio =='false'){
        console.log('servicio-vacio');
        self.data.iding=id;
      }else{
        console.log('servicio-lleno');
        if(self.data.iding==id){
          c=1;
        }else{
          c=2;
          alert('SERIVICO EN USO');
        }
      }
    }
    var options={
      type : 'post',
      url : 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleRecion',
      data: {
        'id' : id
      },
    };
    if(c==1){
      self.render();
    }
    if(c==0){
      console.log('llena denuevo');
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
            idDetalle : arr[i].id_detalle,
            estado :'FALSE',
            tipo : arr[i].tipo_ingreso,
            descripcion : arr[i].descripcion,
            cantidad : arr[i].cantidad_material
          };
          self.data.materiales.push(m);
        }
        self.data.servicio='true';
        self.render();
      })
      .fail(function(xhr) {
        alert('Hubo un error al guardar :(');
        console.log(xhr.responseText);
      })
      .always(function() {
        //Se ejecuta en ambos casos después de la respuesta
      });
    }
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
    if(self.data.materiales[index].estado=='FALSE'){
      $m.find('#estado').prop("checked", false);
    }else{
      $m.find('#estado').prop("checked",true);
    }
    $m.find('.tipo').text(self.data.materiales[index].tipo);
    $m.find('.descripcion').text(self.data.materiales[index].descripcion);
    $m.find('.cantidad').text(self.data.materiales[index].cantidad);
    self.addEvents(index,$m);
    return $m;
  },

  renderCarga: function (index, elemento) {
    var self=this;
    var $m=$(self.tmpl2);
      $m.find('.idCarga').text(self.data.materiales[index].idDetalle);
      $m.find('.tipoCarga').text(self.data.materiales[index].tipo);
      $m.find('.descripcionCarga').text(self.data.materiales[index].descripcion);
      $m.find('.cantidadCarga').text(self.data.materiales[index].cantidad);
      return $m;
  },

  addEvents: function(index,$fila){
    var self=this;
    $fila.find("#estado").change(function (ev) {
      if( $(this).prop('checked') ) {
        self.data.materiales[index].estado='TRUE';
      }else{
        self.data.materiales[index].estado='FALSE';
      }
    });
  },

  llenaCarga: function () {
    var self = this;
    $('#carUltrazonica').empty();
    self.data.materiales.forEach(function(el, i){
      if(self.data.materiales[i].estado=='TRUE'){
          self.renderCarga(i, el).appendTo('#carUltrazonica');
      }
    });
  },

  restart : function(){
		var self = this;
    self.init();
  },

};
