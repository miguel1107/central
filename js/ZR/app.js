window.IngresoMaterial={

  init : function(){
		var self = this;

		if(!self.tmpl){
      self.tmpl = $('#tmpl-material').text();
    }
    self.data={
      materiales :[]
    };
    self.render();
	},

  renderMaterial : function(index, material){
		var self = this;
		var $m = $(self.tmpl);
    $m.find('.tipo').text(self.data.materiales[index].tipo);
    $m.find('#codigo').val(self.data.materiales[index].codigo_mat);
    $m.find('#id').val(self.data.materiales[index].id);
    $m.find('#nombre').val(self.data.materiales[index].material);
    $m.find('#cantidad').val(self.data.materiales[index].cantidad);
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
            var $fi = $(event.target).parent().parent();
            $fi.find('#id').val(ui.item.id_set);
            $fi.find('#codigo').val(ui.item.id_set);
            $fi.find('#nombre').val(ui.item.nombre_set);
          },
        });
      }else{
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
      }
      });

    $fila.find("#form-field-select-1").change(function(ev){
      self.data.materiales[index].combo = $(this).val();
    });

    $fila.find("input[name='cantidad[]']").blur(function(){
      self.data.materiales[index].cantidad = $(this).val();
      $('#cantidadPz').val(suma('cantidad'));
    });


  },

  render : function(){
    var self = this;
    $('#app-materiales').empty();
    self.data.materiales.forEach(function(el, i){
      self.renderMaterial(i, el).appendTo('#app-materiales');
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
      cantidad : 0
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
      cantidad : 0
    };
    self.data.materiales.push(m);
    self.render();
  },

  addKit: function(elem){
    var self = this;
    for (var i = 0; i < elem.cantidad; i++) {
      var m={
        tipo: elem.tipo,
        codigo_mat: '',
        id : '',
        material : '',
        combo : 'AU',
        cantidad : 0
      };
      self.data.materiales.push(m);
      self.render();
    }
  },



};
