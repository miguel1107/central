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
              <th></th>
              <th>Codigo/Id</th>
              <th>Descripcion</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody id="detalleIngMaterial">
            <script type="text/template" id="tmpl-detalle">
              <tr>
                <th><input name="form-field-checkbox" type="checkbox" style="opacity:1;"></th>
                <th>33</th>
                <th>33</th>
                <th>33</th>
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
