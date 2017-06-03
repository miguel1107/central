window.empaque={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-detalle").text();
    };
    if(!self.tmpl2){
      self.tmpl2 = $("#tmpl-empaca").text();
    };
    self.data={
      iding :0,
      servicio:'false',
      materiales :[],
      detalle:[]
    };
    self.render();
    self.llenaCarga();
  },

  llenatabla: function (id) {
    var self=this;
    self.data.materiales=[];
    var options={
      type : 'post',
      url : 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleEmpaquetado',
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
          estado : false,
          idDetalle : arr[i].id_detalle,
          idset:arr[i].id_set,
          idkit:arr[i].id_kit,
          tipoEst : arr[i].codigo_est,
          tipo : arr[i].tipo_ingreso,
          descripcion : arr[i].descripcion,
          cantidad : arr[i].cantidad_material,
          numeroempaques:arr[i].empaques,
          cantidadEmpacar : 0
        };
        self.data.materiales.push(m);
      }
      self.data.servicio='true';
      self.llenaCarga();
    });
  },
  // reder para modal(cantidad y tipo de envoltura), aun no se utiliza
  llenaparaempacar: function (id,cant) {
    var self=this;
    $("#iddetalleMod").val(id);
    $("#cantMat").val(cant);
  },
//---fin--

  llenaDetalle: function (iddet,tipo) {
    var self=this;
    self.data.detalle=[];
    if (tipo=='Set') {
      var url='index.php?c=ctrDetalleset&a=retornaDetalleSet';
    }else if (tipo=='Kit') {
      var url='index.php?c=ctrDetallekit&a=retornaDetalleKit';
    }
    var options={
      type : 'post',
      url : url,
      data: {
        'id' : iddet
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
          tipo : 'Mat',
          descripcion : arr[i].nombre_mat,
          cantidad : arr[i].piezas_material
        };
        self.data.detalle.push(m);
      }
      self.render();
    });
  },
  render: function(){
    var self = this;
    $('#detalle').empty();
    self.data.detalle.forEach(function(el, i){
      self.renderDetalle(i, el).appendTo('#detalle');
    });
  },

  renderDetalle: function (index,elemento) {
    console.log(index);
    var self=this;
    var $m=$(self.tmpl);
    $m.find('.tipo').text(self.data.detalle[index].tipo);
    $m.find('.descripcion').text(self.data.detalle[index].descripcion);
    $m.find('.cantidad').text(self.data.detalle[index].cantidad);
    return $m;
  },
  renderCarga: function (index, elemento, aux) {
    var self=this;
    var $m=$(self.tmpl2);
    $m.find('.idCarga').text(self.data.materiales[index].idDetalle);
    $m.find('.tipoCarga').text(self.data.materiales[index].tipo);
    $m.find('.descripcionCarga').text(self.data.materiales[index].descripcion);

    $m.find('.paquete').text(self.data.materiales[index].numeroempaques +' paquete(s)');
    $m.find('.cantidadCarga').text(self.data.materiales[index].cantidad);
    // if(self.data.materiales[index].tipo=='Mat'){
    //   $m.find('.paquete').text(self.data.materiales[index].cantidad +' paquete(s)');
    //   $m.find('.cantidadCarga').text('1');
    // }else{
    //   $m.find('.paquete').text('1 paquete');
    //   $m.find('.cantidadCarga').text(self.data.materiales[index].cantidad);
    // }
    $m.find("#cantEmpacar").val('0');
    $m.find("#empacarBtn").removeAttr("onclick");
    $m.find("#empacarBtn").attr('onclick', 'empacar('+self.data.materiales[index].idDetalle+','+self.data.materiales[index].cantidad+')');
    $m.find(".green").attr('id',aux);
    self.addEvents(index,$m);
    return $m;
  },

  llenaCarga: function () {
    var self=this;
    $('#carVpro').empty();
    $('#carAu').empty();
    var aux=0;
    self.data.materiales.forEach(function(el, i){
      if(self.data.materiales[i].tipoEst=='VP'){
        self.renderCarga(i, el,aux).appendTo('#carVpro');
      }else{
        self.renderCarga(i, el,aux).appendTo('#carAu');
      }
      aux=aux+1;
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
