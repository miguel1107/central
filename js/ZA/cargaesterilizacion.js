
function cargaportipo() {
  var este=$('#tipoeste').val();
  window.cargaesterilizador.llenaingresos(este);
}

function ver(id) {
  var tipo=$('#tipoeste').val();
  window.cargaesterilizador.llenatabla(id,tipo);
}

function verMat(id) {
  var tip=window.cargaesterilizador.data.materiales[id].tipo;
  if (tip=='Mat') {
  }else if(tip=='Set'){
    var det=window.cargaesterilizador.data.materiales[id].idset;
    $("#modal-table").modal('show');
    window.cargaesterilizador.llenaDetalle(det,tip);
  }else if (tip=='Kit') {
    var det=window.cargaesterilizador.data.materiales[id].idkit;
    $("#modal-table").modal('show');
    window.cargaesterilizador.llenaDetalle(det,tip);
  }
}
