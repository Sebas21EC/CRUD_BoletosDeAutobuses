<div class="modal " id="editChildresn<?php echo $dataRuta['id_ruta']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="" style="background-color: #563d7c !important;">
        <h6 class="" style="color: #fff; text-align: center; font-size:25px;">
            Actualizar Ruta
        </h6>
      </div>


      <form method="POST" action="recibe_actualizar.php">
        <input type="hidden" name="id_ruta" value="<?php echo $dataRuta['id_ruta']; ?>">

            <div class="" id="">

                <div class="">
                  <label for="recipient-name" >ID Ruta:</label>
                  <input type="text" readonly="readonly"  name="id_ruta" class="form-control" value="<?php echo $dataRuta['id_ruta']; ?>" required="true">
                </div>
                <div class="">
                  <label for="recipient-name">Nombre de la ruta:</label>
                  <input type="text" name="nombre_ruta" class="form-control" value="<?php echo $dataRuta['nombre_ruta']; ?>" required="true">
                </div>
                <div class="">
                    <label for="recipient-name" >Ciudad origen</label>
                        <select class="form-control" name="ciudad_origen" onChange="combo(this, 'box')" value="<?php echo $id_ruta; ?>" >
                            <?php 
                                include_once('../conexion_be.php');
                                $con=new Conexion();
                                $conexio=$con->Conectar();
                                $query="select * from ciudades";
                                $st=$conexio->prepare($query);
                                $st->execute();
                                while($row = $st ->fetch(PDO::FETCH_ASSOC))
                                {
                                  if ($row['nombre_ciudad']!=$dataRuta['ciudad_salida']){
                                    ?>
                                        <option><?php echo $row['ciudad_destino'];?></option>
                                    <?php
                                  }else{
                                        ?>
                                            <option  selected="selected" ><?php echo $row['nombre_ciudad'];?></option>
                                        <?php
                                  }
                                    
                                }
                            ?>
                        </select>
                </div>
                <div class="">
                    <label for="recipient-name" >Ciudad origen</label>
                        <select  class="form-control" name="ciudad_destino" onChange="combo(this, 'box')" value="<?php echo $id_ruta; ?>" >
                            <?php 
                            $query="select * from ciudades";
                            $st=$conexio->prepare($query);
                            $st->execute();
                                while($row = $st->fetch(PDO::FETCH_ASSOC))
                                {

                                  if ($row['nombre_ciudad']!=$dataRuta['ciudad_destino']){
                                    ?>
                                        <option><?php echo $row['ciudad_destino'];?></option>
                                    <?php
                                  }else{
                                        ?>
                                            <option  selected="selected" ><?php echo $row['nombre_ciudad'];?></option>
                                        <?php
                                  }
                                }
                                 
                            ?>
                        </select>
                </div>
                <div class="col-md-12">
                  <label for="tiempo_estimado" class="form-label">Tiempo estimado (minutos)</label>
                  <input type="number" class="form-control" name="tiempo_estimado" required='true' value="<?php echo $dataRuta['tiempo_estimado']; ?>">
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