$(document).on('click', '#kit', function(){
  $("#nuevo_kit").modal('show');
});

function suma(a){
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

function enviar(){
  var elem={
    tipo: $('#nombreKit').val(),
    cantidad: parseInt($('#cantidadKit').val())
  };

  console.log(elem);
  window.IngresoMaterial.addKit(elem);
  $("#nuevo_kit").modal('hide');
}

function guardarServicio(){
  var id=$('#idempleado').val();
  var idrec=$('#idrecibe').val();
  var idserv=$('#idservicio').val();
  var total=$('#cantidadPz').val();
  var materiales=(window.IngresoMaterial.data.materiales);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].tipo;
    m[1]=materiales[i].id;
    m[2]=materiales[i].material;
    m[3]=materiales[i].cantidad;
    m[4]=materiales[i].combo;
    mat.push(m);
  }
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
    //Cuando todo es correcto
    alert("Guadado correctamente");
    //window.location="inicio.php";
    console.log(data);
  })
  .fail(function(xhr) {
    alert('Hubo un error al guardar :(');
    console.log(xhr.responseText);
  })
  .always(function() {
    //Se ejecuta en ambos casos después de la respuesta
  });
}

function guardarMedicos(){
  var id=$('#idempleado').val();
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
    m[3]=materiales[i].cantidad;
    m[4]=materiales[i].combo;
    mat.push(m);
  }
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
    //Cuando todo es correcto
    alert("Guardado Correctamente");
    window.location="inicio.php";
    //console.log(data);
  })
  .fail(function(xhr) {
    alert('Hubo un error al guardar :(');
    console.log(xhr.responseText);
  })
  .always(function() {
    //Se ejecuta en ambos casos después de la respuesta
  });
}

function guardarTerceros(){
  var centro=$('#centro').val();
  var res=$('#responsable').val();
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
    m[3]=materiales[i].cantidad;
    m[4]=materiales[i].combo;
    mat.push(m);
  }
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
    //Cuando todo es correcto
    alert("Guardado Correctamente");
    window.location="inicio.php";
    //console.log(data);
  })
  .fail(function(xhr) {
    alert('Hubo un error al guardar :(');
    console.log(xhr.responseText);
  })
  .always(function() {
    //Se ejecuta en ambos casos después de la respuesta
  });
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
    m[3]=materiales[i].cantidad;
    m[4]=materiales[i].combo;
    mat.push(m);
  }
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
    //Cuando todo es correcto
    alert("Guardado Correctamente");
    window.location="inicio.php";
    //console.log(data);
  })
  .fail(function(xhr) {
    alert('Hubo un error al guardar :(');
    console.log(xhr.responseText);
  })
  .always(function() {
    //Se ejecuta en ambos casos después de la respuesta
  });

}
