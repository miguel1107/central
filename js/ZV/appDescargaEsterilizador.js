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
    $m.find(".green").attr('id',self.data.carga[index].idcarga);
    return $m;
  },

  reesterilizar:function (idcarga) {

  }
};
