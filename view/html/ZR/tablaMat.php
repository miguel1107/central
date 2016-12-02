<div class="table-responsive">
  <div class="table-header">
  Materiales Recibidos
  </div>
  <table border="1" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Codigo Material</th>
            <th>Material</th>
            <th>Cantidad</th>
            <th>Tipo Este.</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody id="app-materiales">
        <script type="text/template" id="tmpl-material">
          <tr id="material_detalle" >
            <td class="tipo"></td>
            <td><input type="text" id="codigo" name="codigo[]" value="" onkeypress="return soloNumeros(event);" ><input type="hidden" id="id" name="id[]" value="" ></td>
            <td><input type="text" id="nombre" name="nombre[]" ></td>
            <td><input type="text"id="cantidad" name="cantidad[]" onkeypress="return soloNumeros(event);"></td>
            <td>
              <select name="SelectTipo" id="form-field-select-1">

              </select>
            </td>
            <td class="td-actions">
              <div class="action-buttons">
                <a class="red" id="eliminar">
                  <i class="icon-trash bigger-130"></i>
                </a>
              </div>
            </td>
          </tr>
      </script>
    </tbody>
  </table>
</div>
