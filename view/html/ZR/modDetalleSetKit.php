<div id="modal-table" class="modal hide fade" tabindex="-1">
  <div class="modal-header no-padding">
    <div class="table-header">
      Detalle ingreso
    </div>
  </div>
  <div class="modal-body no-padding">
    <input type="hidden" id="idc" value="">
    <div class="row-fluid">
      <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th >Piezas</th>
          </tr>
        </thead>
        <tbody id="detalle">
          <script type="text/template" id="tmpl-detalle">
            <tr>
              <th class="tipo"></th>
              <th class="descripcion"></th>
              <th class="cantidad"></th>
            </tr>
          </script>
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-small btn-danger pull-left" data-dismiss="modal" onclick="">
      <i class="icon-remove"></i>
      Close
    </button>
  </div>
</div>
