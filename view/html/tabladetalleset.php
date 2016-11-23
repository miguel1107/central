<thead>
  <tr>
    <th>Nombre material</th>
    <th>Numero de piezas</th>
    <th>Accion</th>
  </tr>
</thead>
<tbody>
  <?php
    if(isset($listadet)){
      $suma=0;
    while ($dato=$listadet->fetchObject()) {
      $suma=$suma+$dato->piezas_material;
    ?>

  <tr>
    <td><?php echo $dato->nombre_mat; ?></td>
    <td><?php echo $dato->piezas_material ?></td>
    <td class='td-actions'>
      <div class='action-buttons'>
        <a id="modmodi" class='green'>
          <i class='icon-pencil bigger-130' onclick="editarSet(<?php echo $dato->id_material; ?>,<?php echo $dato->id_set; ?>)"></i>
        </a>
      </div>
    </td>
  </tr>
  <?php  }} ?>
  <thead>
    <tr>
      <th>TOTAL DE MATERIALES</th>
      <th> <?php  echo $suma;?></th>
      <th></th>
    </tr>
  </thead>
</tbody>
