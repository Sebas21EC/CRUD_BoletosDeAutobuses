<?php 
    require_once('../conexion_be.php');
    $conn=new Conexion();
    $conexion=$conn->Conectar();
    
?> 
<form name="form-data" action="recibe_unidad.php" method="POST">

    <div class="row">
      <div class="col-md-12">
          <label for="recipient-name" >ID Unidad: </label>
          <input type="text" class="form-control" name="id_unidad" required='true' autofocus>
      </div>
     
      <div class="col-md-12">
        <label for="id_conductor" >ID conductor: </label>
        <select class="form-control" name="id_conductor" onChange="combo(this, 'box')" >
            <?php
            $query="select * from conductores";
            $stmt=$conexion->prepare($query);
            $stmt->execute();
                while($row = $stmt ->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                    <option  selected="selected" ><?php echo $row['id_conductor'];?></option>
                <?php       
                }
                ?>
        </select>

      </div>

      <div class="col-md-12">
          <label for="numero_asientos" >Número de asientos: </label>
          <input type="number" class="form-control" name="numero_asientos" required='true' autofocus>
      </div>

      <div class="col-md-12">
          <label for="detalles" >Detalles: </label>
          <input type="text" class="form-control" name="detalles" required='true' autofocus>
      </div>
      
    </div>
      <div class="row ">
          <div class="col-12">
              <button class="btn btn-primary btn-block" id="btnEnviar">
                  Agregar Ruta
              </button>
          </div>
      </div>
</form>