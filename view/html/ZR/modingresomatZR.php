<div id="nuevo_kit" class="modal fade" role="dialog">
  <form class="form-horizontal" onsubmit="return false;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Agregar Kit</h4>
    </div><br>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Nombre Kit: </label>
      <div class="controls">
        <input type="text" id="nombreKit" name="nombreKit" placeholder="nombreKit">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Numero de materiales: </label>
      <div class="controls">
        <input type="text" id="cantidad" name="cantidad" placeholder="cantidad">
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save" onclick="enviar()" />
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
    </div>
  </form>
</div>
