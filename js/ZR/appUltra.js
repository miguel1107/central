window.ultrazonica={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-detalle").text();
    }
    if(!self.tmpl2){
      self.tmpl2 = $("#tmpl-carga").text();
    }
    if(!self.tmpl3){
      self.tmpl3 = $("#tmpl-vercarga").text();
    }
    self.data={
      iding :0,
      servicio:'false',
      materiales :[],
      carga :[],
      ids:[]
    };

    self.render();
    self.llenaCarga();
  },

  llenatabla: function (id) {
    var self=this;
    var c=0; //0->llena denuevo 1->esta lleno y id iguales 2->esta lleno id dif
    for (var i = 0; i < self.data.ids.length; i++) {
      if (self.data.ids[i]==id) {
        c=2;
      }
    }
    if (c!=2) {
      self.data.ids.push(id);
    }
    // if (self.data.iding == 0) {
    //   self.data.iding=id;
    // }else{
    //   if(self.data.servicio =='false'){
    //     self.data.iding=id;
    //   }else{
    //     if(self.data.iding==id){
    //       c=1;
    //     }else{
    //       c=2;
    //       $('#contenidoWarning').text('Servicio en uso');
    //       $("#alertWarning").modal('show');
    //     }
    //   }
    // }

    if(c==2){
      self.render(id);
      console.log('id existe');
      $("#modal-table").modal('show');
    }else {
      var options={
        type : 'post',
        url : 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleRecion',
        data: {
          'id' : id
        },
      };
      console.log('llena denuevo');
      $.ajax(options)
      .done(function(data) {
        var json=data;
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }
        if (arr.length==0) {
          $('#contenidoWarning').text('Esperando descarga');
          $("#alertWarning").modal('show');
        }else{
          for (var i = 0; i < arr.length; i++) {
            var m={
              idDetalle : arr[i].id_detalle,
              estado :'FALSE',
              tipo : arr[i].tipo_ingreso,
              descripcion : arr[i].descripcion,
              cantidad : arr[i].cantidad_material,
              id:id
            };
            self.data.materiales.push(m);
          }
          self.data.servicio='true';
          self.render(id);
          $("#modal-table").modal('show');
        }
      })
    }
  },

  render: function(id){
    console.log(id);
    var self = this;
    $('#detalleIngMaterial').empty();
    self.data.materiales.forEach(function(el, i){
      if (self.data.materiales[i].id==id) {
          self.renderDetalle(i, el,id).appendTo('#detalleIngMaterial');
      }
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

  cancelar: function () {
    var self=this;
    self.data.iding=0;
    self.init();
  },

  llenavercarga: function (id) {
    var self=this;
    var a = [];
    self.data.carga= a;
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaUltrazonica&a=verCarga',
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
          idDetalle : arr[i].id_detalle,
          tipo : arr[i].tipo_ingreso,
          descripcion : arr[i].descripcion,
          cantidad : arr[i].cantidad_material
        };
        self.data.carga.push(m);
      }
      self.rendervercargaini();
    })
  },

  rendervercargaini: function () {
    var self = this;
    $('#detalleCarga').empty();
    self.data.carga.forEach(function(el, i){
      self.rendervercarga(i, el).appendTo('#detalleCarga');
    });
  },

  rendervercarga: function(index, elemento) {
    var self=this;
    var $m=$(self.tmpl3);
    $m.find('.tipo').text(self.data.carga[index].tipo);
    $m.find('.descripcion').text(self.data.carga[index].descripcion);
    $m.find('.cantidad').text(self.data.carga[index].cantidad);
    console.log('llena');
    return $m;
  }
};
