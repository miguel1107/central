window.salidamateriales={
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
    //self.llenaCargaEste();
  },

};
