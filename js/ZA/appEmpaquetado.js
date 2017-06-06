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
          iding:id,
          idDetalle : arr[i].id_detalle,
          idset:arr[i].id_set,
          idkit:arr[i].id_kit,
          tipoEst : arr[i].codigo_est,
          tipo : arr[i].tipo_ingreso,
          descripcion : arr[i].descripcion,
          cantidad : arr[i].cantidad_material,
          numeroempaques:arr[i].empaques,
          faltaempacar:arr[i].falta_empacar,
          cantidadEmpacar : 0
        };
        var ii=i;
        self.data.materiales.push(m);
      }
      var t=0;
      while (ii>=0) {
        if (self.data.materiales[ii].faltaempacar!=0) {
          t=1;
        }
        ii=ii-1;
      }
      self.data.servicio='true';
      if (t==1) {
        self.llenaCarga();
      }else{
        self.cambiaEstadoGeneral(id);
        location.reload(true);
      }

    });
  },
  // reder para modal(cantidad y tipo de envoltura), aun no se utiliza
  llenaparaempacar: function (id,cant,t,iding) {
    var self=this;
    $("#idingreso").val(iding);
    $("#iddetalleMod").val(id);
    $("#cantEmp").val(cant);
    $('#ti').val(t);
    $("#cantEmapacar").val('');
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

    $m.find("#cantEmpacar").val('0');
    $m.find("#empacarBtn").removeAttr("onclick");
    if (self.data.materiales[index].faltaempacar=='0') {
      $m.find("#empacarBtn").attr('disabled', 'disabled');
    }else{
      $m.find("#empacarBtn").attr('onclick', 'empacar('+self.data.materiales[index].idDetalle+','+self.data.materiales[index].faltaempacar+','+aux+')');
    }
    $m.find(".green").attr('id',aux);
    //self.addEvents(index,$m);
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

  cambiaEstadoGeneral: function (iding) {
    var options={
      type : 'post',
      url : 'index.php?c=ctrEmpaque&a=actualizaEmpaquetadoTotal',
      data: {
        'id' : iding
      },
    };
    $.ajax(options).done(function (data) {
      if (data==1) {
        console.log('cambio estado');
      }else{
        console.log('no cambio estado');
      }
    });
  },

};
