<div id="ver_carga" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
      <div class="table-header">
        Detalle carga
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
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody id="detalleCarga">
            <script type="text/template" id="tmpl-vercarga">
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
      <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
        <i class="icon-remove"></i>
        Close
      </button>
    </div>
</div>
