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
    if (!self.tmpl4) {
      self.tmpl4=$("#tmpl-este").text();
    }
    self.data={
      iding :0,
      servicio:'false',
      ingresos:[],
      materiales :[],
      detalle:[],
      carga:[]
    };
    self.llenaCarga();
    self.render();
    self.cambiaEstadoGeneral();
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

  llenatabla: function (id,tipo,descripcion) {
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
          faltacargar:arr[i].falta_cargareste,
          cantidadEmpacar : 0,
          descripcioning: descripcion,
          porcargar:arr[i].falta_cargareste
        };
        var ii=i;
        self.data.materiales.push(m);
      }
      var t=0;
      while (ii>=0) {
        if (self.data.materiales[ii].faltacargar!=0) {
          t=1;
        }
        ii=ii-1;
      }
      self.data.servicio='true';
      //console.log(t);
      //if (t==1) {
        self.llenaCarga();
      // }else{
      //   self.cambiaEstadoGeneral(id);
      //   location.reload(true);
      // }
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
    $m.find('.cantidadCarga').text(self.data.materiales[index].cantidad);

    $m.find("#cantEmpacar").val('0');
    $m.find("#empacarBtn").removeAttr("onclick");
    if (self.data.materiales[index].porcargar=='0') {
      $m.find("#empacado").attr('style','display:block');
      $m.find("#empacarBtn").attr('style','display:none');
    }else{
      $m.find('.paquete').text(self.data.materiales[index].numeroempaques +' paquete(s): faltan cargar '+self.data.materiales[index].porcargar+' paquete(s)');
      $m.find("#empacarBtn").attr('onclick', 'cargar('+self.data.materiales[index].idDetalle+','+self.data.materiales[index].porcargar+','+aux+')');
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

  llenaparacarga:function (id,cant,falta,aux) {
    var self=this;
    var desing=window.cargaesterilizador.data.materiales[aux].descripcioning;
    $("#iddetalleMod").val(id);
    $("#cantEmp").val(cant);
    $("#cantEmapacar").val('');
    $("#faltaempacar").val(falta);
    $("#position").val(aux);
  },

  agregaCarga:function(iddet,cant,position,tipo) {
    var self=this;
    var poremcar=self.data.materiales[position].porcargar;
    var poremcardespues=poremcar-cant;
    console.log(poremcardespues);
    self.data.materiales[position].porcargar=poremcardespues;
    var m={
      iddetalle: iddet,
      faltacargar:poremcardespues,
      cantidad: cant,
      descripcion: self.data.materiales[position].descripcion,
      tipo: self.data.materiales[position].tipo,
      desing: self.data.materiales[position].descripcioning,
      numpiezas:self.data.materiales[position].cantidad,
    };
    self.data.carga.push(m);
    self.llenaCargaEste();
    self.llenaCarga();
    //self.llenatabla(self.data.materiales[position].iding,tipo,self.data.materiales[position].descripcioning);
    $("#emp").modal('hide');
  },

  llenaCargaEste: function () {
    var self=this;
    $('#cargaEste').empty();
    var aux=0;
    self.data.carga.forEach(function(el, i){
      self.renderCargaEste(i, el,aux).appendTo('#cargaEste');
      aux=aux+1;
    });
  },

  renderCargaEste: function (index,elemento,aux) {
    var self=this;
    var $m=$(self.tmpl4);
    $m.find('.idCarga').text(self.data.carga[index].iddetalle);
    $m.find('.descring').text(self.data.carga[index].desing);
    $m.find('.empaques').text(self.data.carga[index].cantidad);
    $m.find('.tipoCarga').text(self.data.carga[index].tipo);
    $m.find('.descripcionCarga').text(self.data.carga[index].descripcion);
    $m.find('.piezas').text(self.data.carga[index].numpiezas);
    $m.find(".red").attr('id',aux);
    return $m;
  },

  cancelar: function () {
    var self=this;
    self.data.iding=0;
    self.init();
  },

  cambiaEstadoGeneral: function () {
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaEsterilizacion&a=actualizaCargaEsteTotal',
      data: {
      },
    };
    $.ajax(options).done(function (data) {console.log(data);});
  },


};
