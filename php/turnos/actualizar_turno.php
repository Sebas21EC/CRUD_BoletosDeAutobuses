<div class="modal " id="editChildresn<?php echo $dataTurno['id_turno']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="" style="background-color: #563d7c !important;">
        <h6 class="" style="color: #fff; text-align: center; font-size:25px;">
          Actualizar Turno
        </h6>
      </div>


      <form method="POST" action="recibe_actualizar.php">
        <input type="hidden" name="id_ruta" value="<?php echo $dataTurno['id_turno']; ?>">

        <div class="" id="">

          <div>
            <label for="id_turno">ID turno: </label>
            <input type="text" readonly="readonly" class="form-control" name="id_turno" value="<?php echo $dataTurno['id_turno']; ?>" required='true' autofocus> 
          </div>

          <div class="col-md-12">
            <label for="ruta">Ruta: </label>
            <select class="form-control" name="ruta" onChange="combo(this, 'box')">
              <?php
              $query = "select * from rutas";
              $st = $conexion->prepare($query);
              $st->execute();
              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {

                if ($row['id_ruta'] != $dataTurno['id_ruta']) {
              ?>
                  <option><?php echo $row['id_ruta']; ?>: <?php echo $row['nombre_ruta']; ?></option>

                <?php
                } else {
                ?>
                  <option selected="selected"><?php echo $row['id_ruta']; ?>: <?php echo $row['nombre_ruta']; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div>
            <label for="unidad">Unidad: </label>
            <select class="form-control" name="unidad" onChange="combo(this, 'box')">
              <?php
              $query = "select * from unidades";
              $stm = $conexion->prepare($query);
              $stm->execute();
              while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                if ($row['id_unidad'] != $dataTurno['id_unidad']) {
              ?>
                  <option><?php echo $row['id_unidad']; ?>: <?php echo $row['detalles']; ?></option>

                <?php
                } else {
                ?>
                  <option selected="selected"><?php echo $row['id_unidad']; ?>: <?php echo $row['detalles']; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>


          <div>
            <label for="precio">Precio: </label>
            <input type="number" step="0.01" class="form-control" name="precio" value="0,0" required='true' autofocus>
          </div>

          <div>
            <label for="hora">Hora: </label>
            <input type="time" class="form-control" name="hora" value="<?php echo $dataTurno['hora']; ?>" required='true' autofocus>
          </div>

        </div>
        <div class="">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>

    </div>
  </div>
</div>