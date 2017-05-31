function abreModal() {
  $("#nuevo_kit").modal('show');
}

function suma(a){
  var suma = 0
  var mat=[];
  var canmat=[]
  $("input[name='"+a+"[]']").each(function(i){
    if(isNaN(parseInt($(this).val()))){
      var a = 0;
    }else{
      var  a = parseFloat($(this).val());
    }
    mat.push(a);
  });
  $("input[name='cantidadMat[]']").each(function(i){
    if(isNaN(parseInt($(this).val()))){
      var b = 0;
    }else{
      var  b = parseFloat($(this).val());
    }
    canmat.push(b);
  });
  var mult=[];
  for (var i = 0; i < mat.length; i++) {
    var s=mat[i];
    var s1=canmat[i];
    var mul=parseInt(s)*parseInt(s1);
    mult.push(mul);
  }
  for (var i = 0; i < mult.length; i++) {
    suma += mult[i];
  }
  return suma;
}

function sumaKit(a){
  var suma = 0;
  $("input[name='"+a+"[]']").each(function(i){
    if(isNaN(parseInt($(this).val()))){
      var a = 0;
    }else{
      var  a = parseFloat($(this).val());
    }
    suma += a;
  });
  return suma;
}

function soloNumeros(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }else{
    return true;
  }
}

function guardarServicio(){
  var id=$('#empleado').val();
  var idrec=$('#idrecibe').val();
  var idserv=$('#servicio').val();
  var total=$('#cantidadPz').val();
  var materiales=(window.IngresoMaterial.data.materiales);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].tipo;
    m[1]=materiales[i].id;
    m[2]=materiales[i].material;
    m[3]=materiales[i].cantidadMat;
    m[4]=materiales[i].combo;
    m[5]=materiales[i].cantidad;
    mat.push(m);
  }
  if (id=='') {
    $('#contenidoWarning').text('Ingrese Empleado');
    $("#alertWarning").modal('show');
  }else if(idserv=='') {
    $('#contenidoWarning').text('Ingrese Servicio');
    $("#alertWarning").modal('show');
  }else if (total=='0') {
    console.log('cantidad');
    $('#contenidoWarning').text('Ingrese materiales');
    $("#alertWarning").modal('show');
  } else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrIngresoMaterial&a=regIngresoMaterialServicio',
      data: {
        'id' : id,
        'idrec' : idrec,
        'idserv' : idserv,
        'total' : total,
        'materiales' : mat
      },
    };
    $.ajax(options)
    .done(function(data) {
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    });
  }
}

function guardarMedicos(){
  var id=$('#empleado').val();
  var idrec=$('#idrecibe').val();
  var total=$('#cantidadPz').val();
  var materiales=(window.IngresoMaterial.data.materiales);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].tipo;
    m[1]=materiales[i].id;
    m[2]=materiales[i].material;
    m[3]=materiales[i].cantidadMat;
    m[4]=materiales[i].combo;
    m[5]=materiales[i].cantidad;
    mat.push(m);
  }
  if (id=='') {
    $('#contenidoWarning').text('Ingrese Empleado');
    $("#alertWarning").modal('show');
  }else if (total=='0') {
    console.log('cantidad');
    $('#contenidoWarning').text('Ingrese materiales');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrIngresoMaterial&a=regIngresoMaterialMedico',
      data: {
        'id' : id,
        'idrec' : idrec,
        'total' : total,
        'materiales' : mat
      },
    };
    $.ajax(options)
    .done(function(data) {
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    });
  }
}

function guardarTerceros(){
  var centro=$('#centro').val();
  var res=$('#responsable').val();
  var idrec=$('#idrecibe').val();
  var total=$('#cantidadPz').val();
  var materiales=(window.IngresoMaterial.data.materiales);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].tipo;
    m[1]=materiales[i].id;
    m[2]=materiales[i].material;
    m[3]=materiales[i].cantidadMat;
    m[4]=materiales[i].combo;
    m[5]=materiales[i].cantidad;
    mat.push(m);
  }
  if (centro=='') {
    $('#contenidoWarning').text('Ingrese Centro de Procedencia');
    $("#alertWarning").modal('show');
  }else if (res=='') {
    $('#contenidoWarning').text('Ingrese Responsable');
    $("#alertWarning").modal('show');
  }else if (total=='0') {
    console.log('cantidad');
    $('#contenidoWarning').text('Ingrese materiales');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrIngresoMaterial&a=regIngresoMaterialTerceros',
      data: {
        'centro' : centro,
        'res' : res,
        'idrec' : idrec,
        'total' : total,
        'materiales' : mat
      },
    };
    $.ajax(options)
    .done(function(data) {
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    });
  }
}

function guardarCasaComercial() {
  var res=$('#responsable').val();
  var centro=$('#centro').val();
  var idrec=$('#idrecibe').val();
  var total=$('#cantidadPz').val();
  var materiales=(window.IngresoMaterial.data.materiales);
  //alert(total);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].tipo;
    m[1]=materiales[i].id;
    m[2]=materiales[i].material;
    m[3]=materiales[i].cantidadMat;
    m[4]=materiales[i].combo;
    m[5]=materiales[i].cantidad;
    mat.push(m);
  }
  if (res=='') {
    $('#contenidoWarning').text('Ingrese Responsable');
    $("#alertWarning").modal('show');
  }else if (centro=='') {
    $('#contenidoWarning').text('Ingrese Centro de Medico');
    $("#alertWarning").modal('show');
  }else if (total=='0') {
    console.log('cantidad');
    $('#contenidoWarning').text('Ingrese materiales');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrIngresoMaterial&a=regIngresoMaterialCasaComercial',
      data: {
        'centro' : centro,
        'res' : res,
        'idrec' : idrec,
        'total' : total,
        'materiales' : mat
      },
    };
    $.ajax(options)
    .done(function(data) {
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    });
  }
}

function agregaMat() {
  window.IngresoMaterial.addMaterialKit();
}

function guardarKit() {
  var idrec=$('#idrecibe').val();
  var nomKit=$('#nombreKit').val();
  var totalKit=$('#cantidadPzKit').val();
  var kit=window.IngresoMaterial.data.materialKit;
  var k=[];
  for (var i = 0; i < kit.length; i++) {
    var m=[];
    m[0]=kit[i].id;
    m[2]=kit[i].material;
    m[1]=kit[i].cantidad;
    k.push(m);
  }
  var options={
    type : 'post',
    url : 'index.php?c=ctrKit&a=registroKit',
    data: {
      idrec: idrec,
      nomKit: nomKit,
      totalKit: totalKit,
      k: k
    },
  };
  console.log(options.data.nomKit);
  $.ajax(options)
  .done(function(data) {
    if(data==1){
      $('#contenidoExitoKit').text('Registro Existoso!!');
      $("#alertExitoKit").modal('show');
    }else{
      $('#contenidoError').text('Error al insertar!!');
      $("#alertError").modal('show');
    }
  })
}

function cancelar() {
  IngresoMaterial.cancelar();
}

function redireccionar() {
  location.reload(true);
}

function cerrarModal() {
  while(window.IngresoMaterial.data.materialKit.length > 0) {
    window.IngresoMaterial.data.materialKit.pop();
  }
  $('#nombreKit').val('');
  $('#cantidadPzKit').val('');
  $("#nuevo_kit").modal('hide');
}

function cerrarModalKit() {
  while(window.IngresoMaterial.data.materialKit.length > 0) {
    window.IngresoMaterial.data.materialKit.pop();
  }
  $('#nombreKit').val('');
  $('#cantidadPzKit').val('');
  $("#nuevo_kit").modal('hide');
  $('#alertExitoKit').modal('hide');
}

function eliminarFila(id) {
  window.IngresoMaterial.eliminarFila(id);
}

function eliminarFilaKit(id) {
  window.IngresoMaterial.eliminarFilaKit(id);
}

function ver(id) {
  var materiales=(IngresoMaterial.data.materiales);
  for (var i = 0; i <materiales.length; i++) {
    if(id==i){
      if (materiales[i].tipo=='Mat') {
        $('#contenidoWarning').text('No se puede ver detalle');
        $("#alertWarning").modal('show');
      }else{
        console.log(materiales[i].id);
        $("#modal-table").modal('show');
        window.IngresoMaterial.llenatabla(materiales[i].id,materiales[i].tipo);
      }
    }
  }
}
