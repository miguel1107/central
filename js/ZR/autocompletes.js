$().ready(function() {
    $( "#empleado" ).autocomplete({
      source: 'index.php?c=ctrempleado&a=autocomplete',
      select: function(event, ui) {
        event.preventDefault();
        $('#empleado').val(ui.item.nombres);
        $('#form-input-readonly').val(ui.item.emp_dni);
        $('#idempleado').val(ui.item.emp_id);
      },
      messages: {
       noResults: '',
       results: function() {}
      },
    });
});

$().ready(function() {
    $( "#servicio" ).autocomplete({
      source: 'index.php?c=ctrServicio&a=autocomplete',
      select: function(event, ui) {
        event.preventDefault();
        $('#servicio').val(ui.item.nombre);
        $('#idservicio').val(ui.item.id_servicio);
      },
      messages: {
       noResults: '',
       results: function() {}
      },
    });
});
