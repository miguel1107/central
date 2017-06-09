window.cargaesterilizador={
  init: function(){
    var self=this;
    if(!self.tmpl){
      self.tmpl = $("#tmpl-ingresos").text();
    };
    if(!self.tmpl2){
      self.tmpl2 = $("#tmpl-empaca").text();
    };
    if(!self.tmpl3){
      self.tmpl3 = $("#tmpl-detalle").text();
    };
    self.data={
      iding :0,
      servicio:'false',
      ingresos:[],
      materiales :[],
      detalle:[]
    };
    self.llenaCarga();
    self.render();
  },

  llenaingresos: function (tipo) {
    var self=this;
    self.data.ingresos=[];
    self.data.materiales=[];
    var options={
      type: 'post',
      url: 'index.php?c=ctrIngresoMaterial&a=retornaIngresosparaCargaEste',
      data:{
        tipoEste: tipo
      }
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
          iding: arr[i][0],
          prop: arr[i][1],
          fecha:arr[i][2],
          descripcion:arr[i][3]
        };
        self.data.ingresos.push(m);
      }
      self.renderIngresos();
    });
  },

  renderIngresos: function () {
    var self=this;
    $('#carEste').empty();
    self.data.ingresos.forEach(function(el, i){
      self.renderIngresosDetalle(i, el).appendTo('#carEste');
    });
  },

  renderIngresosDetalle: function (index, elemento) {
    var self=this;
    var $m=$(self.tmpl);
    $m.find('.id').text(self.data.ingresos[index].iding);
    if (self.data.ingresos[index].prop=='S') {
      $m.find('.propietario').text('Servicio');
    }else if (self.data.ingresos[index].prop=='M') {
      $m.find('.propietario').text('Médico');
    }else if (self.data.ingresos[index].prop=='P') {
      $m.find('.propietario').text('Particular');
    }else if (self.data.ingresos[index].prop=='T') {
      $m.find('.propietario').text('Terceros');
    }
    $m.find('.fecha').text(self.data.ingresos[index].fecha);
    $m.find('.descripcion').text(self.data.ingresos[index].descripcion);
    $m.find('.green').attr('id',self.data.ingresos[index].iding);
    return $m;
  },

  llenatabla: function (id,tipo) {
    var self=this;
    self.data.materiales=[];
    var options={
      type : 'post',
      url: 'index.php?c=ctrDetalleIngresoMaterial&a=retornaDetalleCargaesterilizacion',
      data: {
        'id' : id,
        'tipo': tipo
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
      //if (t==1) {
        self.llenaCarga();
      //}else{
        //self.cambiaEstadoGeneral(id);
        //location.reload(true);
      //}
    });
  },

  llenaCarga: function () {
    var self=this;
    $('#carEster').empty();
    var aux=0;
    self.data.materiales.forEach(function(el, i){
      self.renderCarga(i, el,aux).appendTo('#carEster');
      aux=aux+1;
    });
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
    var $m=$(self.tmpl3);
    $m.find('.tipo').text(self.data.detalle[index].tipo);
    $m.find('.descripcion').text(self.data.detalle[index].descripcion);
    $m.find('.cantidad').text(self.data.detalle[index].cantidad);
    return $m;
  },


};
