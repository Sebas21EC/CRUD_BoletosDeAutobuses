<div class="modal " id="editChildresn<?php echo $dataUnidad['id_unidad']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="" style="background-color: #563d7c !important;">
        <h6 class="" style="color: #fff; text-align: center; font-size:25px;">
            Actualizar Unidad
        </h6>
      </div>


      <form method="POST" action="recibe_actualizar.php">
        <input type="hidden" name="id_ruta" value="<?php echo $dataUnidad['id_unidad']; ?>">

            <div class="" id="">

                <div class="">
                  <label for="recipient-name" >ID Unidad:</label>
                  <input type="text" readonly="readonly"  name="id_unidad" class="form-control" value="<?php echo $dataUnidad['id_unidad']; ?>" required="true">
                </div>
                <div class="">
                    <label for="recipient-name" >ID Conductor</label>
                        <select class="form-control" name="id_conductor" onChange="combo(this, 'box')" value="<?php echo $id_ruta; ?>" >
                            <?php 
                                include_once('../conexion_be.php');
                                $con=new Conexion();
                                $conexio=$con->Conectar();
                                $query="select * from conductores";
                                $st=$conexio->prepare($query);
                                $st->execute();
                                while($row = $st ->fetch(PDO::FETCH_ASSOC))
                                {
                                             
                                  if ($row['id_conductor']!=$dataUnidad['id_conductor']){
                                      ?>
                                          <option><?php echo $row['id_conductor'];?></option>
                  
                                      <?php
                                  }else{
                                      ?>
                                      <option  selected="selected" ><?php echo $row['id_conductor'];?></option>
                                  <?php
                                  }
                            
                                    
                                }
                            ?>
                        </select>
                </div>
                <div class="">
                  <label for="recipient-name" >Numero de asientos:</label>
                  <input type="number"   name="numero_asientos" class="form-control" value="<?php echo $dataUnidad['numero_asientos']; ?>" required="true">
                </div>

                <div class="">
                  <label for="recipient-name" >detalles:</label>
                  <input type="text"  name="detalles" class="form-control" value="<?php echo $dataUnidad['detalles']; ?>" required="true">
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