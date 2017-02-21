window.empaque={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-empaque").text();
    };
    if(!self.tmpl2){
      self.tmpl2 = $("#tmpl-empaca").text();
    };
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
        self.data.iding=id;
      }else{
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
      url : 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleEmpaquetado',
      data: {
        'id' : id
      },
    };
    if(c==1){
      self.render();
    }
    if(c==0){
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
            estado : false,
            idDetalle : arr[i].id_detalle,
            tipoEst : arr[i].codigo_est,
            tipo : arr[i].tipo_ingreso,
            descripcion : arr[i].descripcion,
            cantidad : arr[i].cantidad_material,
            cantidadEmpacar : 0
          };
          self.data.materiales.push(m);
        }
        self.data.servicio='true';
        self.render();
      });
    }
  },

  render: function(){
    var self = this;
    $('#detalleEmpaque').empty();
    self.data.materiales.forEach(function(el, i){
      self.renderDetalle(i, el).appendTo('#detalleEmpaque');
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

  renderCarga: function (index, elemento) {
    var self=this;
    var $m=$(self.tmpl2);
    $m.find('.idCarga').text(self.data.materiales[index].idDetalle);
    $m.find('.tipoCarga').text(self.data.materiales[index].tipo);
    $m.find('.descripcionCarga').text(self.data.materiales[index].descripcion);
    if(self.data.materiales[index].tipo=='Mat'){
      $m.find('.paquete').text(self.data.materiales[index].cantidad +' paquete(s)');
      $m.find('.cantidadCarga').text('1');
    }else{
      $m.find('.paquete').text('1 paquete');
      $m.find('.cantidadCarga').text(self.data.materiales[index].cantidad);
    }
    $m.find("#cantEmpacar").val('0');
    self.addEvents(index,$m);
    return $m;
  },

  llenaCarga: function () {
    var self=this;
    $('#carVpro').empty();
    $('#carAu').empty();
    self.data.materiales.forEach(function(el, i){
      if(self.data.materiales[i].tipoEst=='VP'){
        self.renderCarga(i, el).appendTo('#carVpro');
      }else{
        self.renderCarga(i, el).appendTo('#carAu');
      }
    });
  },

  addEvents: function(index, $fila) {
    var self=this;
    $fila.find("#estado").change(function (ev) {
      if( $(this).prop('checked') ) {
        $fila.find("#cantEmpacar").removeAttr('disabled');
        self.data.materiales[index].estado=true;
      }else{
        $fila.find("#cantEmpacar").attr('disabled','true');
        self.data.materiales[index].estado=false;
      }
    });

    $fila.find("#cantEmpacar").blur(function(){
      self.data.materiales[index].cantidadEmpacar = $(this).val();
    });
  },

  cancelar: function () {
    var self=this;
    self.data.iding=0;
    self.init();
  },

};
