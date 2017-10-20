window.descargaEsterilizador={
  init: function(){
    var self=this;
    if (!self.tmpl) {
      self.tmpl=$("#tmpl-este").text();
    }
    self.data={
      iding :0,
      servicio:'false',
      carga:[]
    };
    self.llenaCargaEste();
  },

  llenaCarga: function(id) {
    var self=this;
    self.data.carga=[];
    //self.data.materiales=[];
    var options={
      type: 'post',
      url: 'index.php?c=ctrCargaEsterilizacion&a=listaDescarga',
      data:{
        idEste: id
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
          descripcioning:arr[i][3],
          iddet:arr[i][4],
          paquetes:arr[i][5],
          descmat:arr[i][6],
          piezas:arr[i][7],
          tipo: arr[i][8],
          idcarga: arr[i][9],
          ideste:arr[i][10]
        };
        self.data.carga.push(m);
      }
      self.llenaCargaEste();
    });
  },

  llenaCargaEste: function () {
    var self=this;
    $('#cargaEste').empty();
    var aux=0;
    self.data.carga.forEach(function(el, i){
      self.renderCarga(i, el,aux).appendTo('#cargaEste');
      aux=aux+1;
    });
  },

  renderCarga: function (index, elemento, aux) {
    var self=this;
    var $m=$(self.tmpl);
    $m.find('.idCarga').text(self.data.carga[index].iddet);
    $m.find('.descring').text(self.data.carga[index].descripcioning);
    $m.find('.empaques').text(self.data.carga[index].paquetes);
    $m.find('.tipoCarga').text(self.data.carga[index].tipo);
    $m.find('.descripcionCarga').text(self.data.carga[index].descmat);
    $m.find('.piezas').text(self.data.carga[index].piezas);
    $m.find(".green").attr('id',self.data.carga[index].idcarga+','+aux+','+self.data.carga[index].iddet);
    return $m;
  },

  reesterilizar:function (idcargaeste,cantrees,cantnorees,i,iddet) {
    var self=this;
    self.data.servicio='true';
    var este=self.data.carga[i].ideste;
    var options={
      type: 'post',
      url: 'index.php?c=ctrReesterilizacion&a=reseet',
      data:{
        idcargaeste: idcargaeste,
        cantrees: cantrees,
        cantnorees: cantnorees,
        este:este,
        iddet: iddet
      }
    };
    $.ajax(options).done(function (data) {
      if (data==1) {
        alert('correcto');
        var es=self.data.carga[i].ideste;
        self.eliminar(i);
        if (self.data.carga.length==0) {
          //terminar carga
          self.desocupaEsterilizador(es);
        }else{
          //sigue carga para terminar
          self.llenaCarga(este,idcargaeste);
        }
      }else{
        alert('incorrecto');
      }
    });
  },

  eliminar: function (pos) {
    var self=this;
    var aux=self.data.carga;
    var aux2=[];
    for (var i = 0; i < aux.length; i++) {
      if (i!=pos) {
        aux2.push(aux[i]);
      }
    }
    self.data.carga=aux2;
  },

  terminardescarga:function () {
    var self=this;
    var m=self.data.carga;
    if (m.length==0) {
      alert("NO TIENE CARGA!!");
    }else{
      var options={
        type: 'post',
        url: 'index.php?c=ctrCargaEsterilizacion&a=terminardescarga',
        data:{
          'materiales': m
        }
      };
      $.ajax(options).done(function (data) {
        console.log(data);
        if (data=='true') {
          location.reload(true);
        }
      })
    }
  },

  desocupaEsterilizador:function (es) {
    var options={
      type: 'post',
      url: 'index.php?c=ctrCargaEsterilizacion&a=desocupeEsterilizador',
      data:{
        'es':es
      }
    };
    $.ajax(options).done(function (data) {
      //console.log(data);
      if (data=='true') {
        location.reload(true);
      }
    })
  },

};
