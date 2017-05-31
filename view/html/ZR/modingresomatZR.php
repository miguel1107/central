<div id="nuevo_kit" class="modal hide fade" role="dialog" >
  <form class="form-horizontal" onsubmit="return false;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" onclick="cerrarModal()">&times;</button>
      <h4 class="modal-title">Agregar Kit</h4>
    </div><br>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Nombre Kit: </label>
      <div class="controls">
        <input type="text" id="nombreKit" name="nombreKit" placeholder="nombreKit">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button class="btn btn-info" type="button" onclick="agregaMat()">
              <i class="icon-ok bigger-110"></i>Agregar Material
        </button>
      </div>
    </div>
    <div class="modal-body no-padding">
      <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
          <tr>
            <th>Codigo Material</th>
            <th>Material</th>
            <th>Cantidad</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody id="app-materialesKit">
          <script type="text/template" id="tmpl-materialKit">
            <tr id="material_detalle" >
              <td><input type="text" id="codigoKit" name="codigoKit[]"  style="width:50px;" value="" onkeypress="return soloNumeros(event);" ><input type="hidden" id="idKit" name="id[]" value="" ></td>
              <td><input type="text" id="nombreKit" name="nombreKit[]" ></td>
              <td><input type="text"id="cantidadKit" name="cantidadKit[]" onkeypress="return soloNumeros(event);" style="width:10px;"></td>
              <td class="td-actions">
                <div class="action-buttons">
                  <a class="red" id="eliminarKit" onclick="eliminarFilaKit(id);" role="button" title="Eliminar">
                    <i class="icon-trash bigger-130"></i>
                  </a>
                </div>
              </td>
            </tr>
          </script>
        </tbody>
      </table>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Total de Piezas: </label>
      <div class="controls">
        <input type="text" id="cantidadPzKit" disabled="true">
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save" onclick="guardarKit()"/>
      <button type="button" class="btn btn-info" data-dismiss="modal" onclick="cerrarModal()">Cancelar</button>
    </div>
  </form>
</div>
