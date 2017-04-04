window.IngresoMaterial={

  init : function(){
		var self = this;

		if(!self.tmpl){
      self.tmpl = $('#tmpl-material').text();
    }

    if(!self.tmpl2){
      self.tmpl2 = $('#tmpl-materialKit').text();
    }

    if (!self.tmpl3) {
      self.tmpl3=$('#tmpl-detalle').text();
    }
    self.data={
      materialKit:[],
      detalle:[],
      materiales :[]
    };
    self.render();
    self.renderKit();
	},

  renderMaterial : function(index, material,aux){
		var self = this;
		var $m = $(self.tmpl);
    $m.find('.tipo').text(self.data.materiales[index].tipo);
    $m.find('#codigo').val(self.data.materiales[index].codigo_mat);
    $m.find('#id').val(self.data.materiales[index].id);
    $m.find('#nombre').val(self.data.materiales[index].material);
    $m.find('#cantidad').val(self.data.materiales[index].cantidad);
    $m.find('#cantidadMat').val(self.data.materiales[index].cantidadMat);
    $m.find('#eliminar').click(function(ev){
			ev.preventDefault();
			$m.remove();
			self.render();
		});
    $.each(self.combo, function(i, el){
      if(self.data.materiales[index].combo == el.codigo){
        $m.find('#form-field-select-1').append('<option value='+el.codigo+' selected>'+el.nombre+'</option>');
      }else{
        $m.find('#form-field-select-1').append('<option value='+el.codigo+'>'+el.nombre+'</option>');
      }
    });
    var ids=self.data.materiales[index].id;
    $m.find(".red").attr('id',aux);
    $m.find(".green").attr('id',aux);
    self.addEvents(index, $m);
		return $m;
	},

  addEvents: function(index, $fila){
    var self = this;
    $fila.find("input[name='codigo[]']").click(function(){
      $(this).autocomplete({
        source: 'index.php?c=ctrMaterial&a=autocomplete',
        select: function(event, ui) {
          event.preventDefault();
          self.data.materiales[index].id = ui.item.id_mat;
          self.data.materiales[index].codigo_mat = ui.item.codigo_mat;
          self.data.materiales[index].material = ui.item.material;
          var $fi = $(event.target).parent().parent();
          $fi.find('#id').val(ui.item.id_mat);
          $fi.find('#codigo').val(ui.item.codigo_mat);
          $fi.find('#nombre').val(ui.item.material);
        },
      });
    });

    $fila.find("input[name='nombre[]']").click(function(){
      if(self.data.materiales[index].tipo=='Set'){
        $(this).autocomplete({
          source: 'index.php?c=ctrSet&a=autocomplete',
          select: function(event, ui) {
            event.preventDefault();
            self.data.materiales[index].id=ui.item.id_set;
            self.data.materiales[index].codigo_mat = ui.item.id_set;
            self.data.materiales[index].material = ui.item.nombre_set;
            self.data.materiales[index].cantidadMat = ui.item.total_piezas;
            self.data.materiales[index].cantidad = 1;
            var $fi = $(event.target).parent().parent();
            $fi.find('#id').val(ui.item.id_set);
            $fi.find('#codigo').val(ui.item.id_set);
            $fi.find('#nombre').val(ui.item.nombre_set);
            $fi.find('#cantidad').val('1');
            $fi.find('#cantidadMat').val(ui.item.total_piezas);
            $('#cantidadPz').val(suma('cantidad'));
          },
        });
      }else if (self.data.materiales[index].tipo=='Mat'){
        $(this).autocomplete({
          source: 'index.php?c=ctrMaterial&a=autocomplete',
          select: function(event, ui) {
            event.preventDefault();
            self.data.materiales[index].id = ui.item.id_mat;
            self.data.materiales[index].codigo_mat = ui.item.codigo_mat;
            self.data.materiales[index].material = ui.item.material;
            var $fi = $(event.target).parent().parent();
            $fi.find('#id').val(ui.item.id_mat);
            $fi.find('#codigo').val(ui.item.codigo_mat);
            $fi.find('#nombre').val(ui.item.material);
            $fi.find('#cantidad').val('1');
            $fi.find('#cantidadMat').val('1');
            $('#cantidadPz').val(suma('cantidad'));
          },
        });
      }else {
        $(this).autocomplete({
          source: 'index.php?c=ctrKit&a=autocomplete',
          select: function(event, ui) {
            event.preventDefault();
            self.data.materiales[index].id = ui.item.id_kit;
            self.data.materiales[index].codigo_mat = ui.item.id_kit;
            self.data.materiales[index].material = ui.item.descripcion;
            self.data.materiales[index].cantidadMat = ui.item.num_materiales;
            var $fi = $(event.target).parent().parent();
            $fi.find('#id').val(ui.item.id_kit);
            $fi.find('#codigo').val(ui.item.id_kit);
            $fi.find('#nombre').val(ui.item.descripcion);
            $fi.find('#cantidad').val('1');
            $fi.find('#cantidadMat').val(ui.item.num_materiales);
            $('#cantidadPz').val(suma('cantidad'));
          },
        });
      }
    });

    $fila.find("#form-field-select-1").change(function(ev){
      self.data.materiales[index].combo = $(this).val();
    });

    $fila.find("input[name='cantidad[]']").blur(function(){
      if(self.data.materiales[index].tipo=='Mat'){
          self.data.materiales[index].cantidad = $(this).val();
      }
      self.data.materiales[index].cantidad = $(this).val();
      $('#cantidadPz').val(suma('cantidad'));
    });

  },

  render : function(){
    var self = this;
    var aux=0;
    $('#app-materiales').empty();
    self.data.materiales.forEach(function(el, i){
      self.renderMaterial(i, el,aux).appendTo('#app-materiales');
      aux=aux+1;
    });
  },

  addMaterial : function(){
    var self = this;
    var m={
      tipo : 'Mat',
      codigo_mat: '',
      id : '',
      material : '',
      combo : 'AU',
      cantidad : 0,
      cantidadMat : 1
    };
    self.data.materiales.push(m);
    self.render();
  },

  addSet : function(){
    var self = this;
    var m={
      tipo : 'Set',
      codigo_mat: '',
      id : '',
      material : '',
      combo : 'AU',
      cantidad : 1,
      cantidadMat : 0
    };
    self.data.materiales.push(m);
    self.render();
  },

  addKit: function(){
    var self = this;
    var m={
      tipo: 'Kit',
      codigo_mat: '',
      id : '',
      material : '',
      combo : 'AU',
      cantidad : 0,
      cantidadMat : 0
    };
    self.data.materiales.push(m);
    self.render();
  },

  addMaterialKit: function () {
    var self = this;
    var m={
      tipo : 'Mat',
      codigo_mat: '',
      id : '',
      material : '',
      cantidad : 0
    };
    self.data.materialKit.push(m);
    self.renderKit();
  },

  renderKit: function(){
    var self = this;
    $('#app-materialesKit').empty();
    self.data.materialKit.forEach(function(el, i){
      self.renderKitMaterial(i, el).appendTo('#app-materialesKit');
    });
  },

  renderKitMaterial: function (index,$fila) {
    var self = this;
    var $m = $(self.tmpl2);
    $m.find('.tipoKit').text(self.data.materialKit[index].tipo);
    $m.find('#codigoKit').val(self.data.materialKit[index].codigo_mat);
    $m.find('#idKit').val(self.data.materialKit[index].id);
    $m.find('#nombreKit').val(self.data.materialKit[index].material);
    $m.find('#cantidadKit').val(self.data.materialKit[index].cantidad);
    $m.find('#eliminarKit').click(function(ev){
      ev.preventDefault();
      $m.remove();
      self.render();
    });
    self.addEventsKit(index, $m);
    return $m;
  },

  addEventsKit: function (index,$fila) {
    var self = this;
    $fila.find("input[name='nombreKit[]']").click(function(){
      $(this).autocomplete({
        source: 'index.php?c=ctrMaterial&a=autocomplete',
        select: function(event, ui) {
          event.preventDefault();
          self.data.materialKit[index].id = ui.item.id_mat;
          self.data.materialKit[index].codigo_mat = ui.item.codigo_mat;
          self.data.materialKit[index].material = ui.item.material;
          var $fi = $(event.target).parent().parent();
          $fi.find('#idKit').val(ui.item.id_mat);
          $fi.find('#codigoKit').val(ui.item.codigo_mat);
          $fi.find('#nombreKit').val(ui.item.material);
        },
      });
    });

    $fila.find("input[name='cantidadKit[]']").blur(function(){
      self.data.materialKit[index].cantidad = $(this).val();
      $('#cantidadPzKit').val(sumaKit('cantidadKit'));
    });
  },

  cancelar: function () {
    var self=this;
    self.init();
  },

  eliminarFila: function (id) {
    var self=this;
    var aux=[];
    for (var i = 0; i < self.data.materiales.length; i++) {
      if (id!=i) {
        aux.push(self.data.materiales[i]);
      }
    }
    self.data.materiales=aux;
    this.render();
  },

  llenatabla: function (id,tipo) {
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
          tipo : 'Mat',
          descripcion : arr[i].nombre_mat,
          cantidad : arr[i].piezas_material
        };
        self.data.detalle.push(m);
      }
      self.renderdetalle();
    });
  },

  renderdetalle: function () {
    var self = this;
    $('#detalle').empty();
    self.data.detalle.forEach(function(el, i){
      self.renderdetallerender(i, el).appendTo('#detalle');
    });
  },

  renderdetallerender: function (index,fila) {
    var self = this;
    var $m = $(self.tmpl3);
    $m.find('.tipo').text(self.data.detalle[index].tipo);
    $m.find('.descripcion').text(self.data.detalle[index].descripcion);
    $m.find('.cantidad').text(self.data.detalle[index].cantidad);
    return $m;
  }
};
