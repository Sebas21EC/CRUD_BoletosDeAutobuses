<?php 
    require_once('../conexion_be.php');
    $conn=new Conexion();
    $conexion=$conn->Conectar();
    
?> 
<form name="form-data" action="recibe_ruta.php" method="POST">

    <div class="row">
      <div class="col-md-12">
          <label for="id_ruta" >ID Ruta</label>
          <input type="number" class="form-control" name="id_ruta" required='true' autofocus>
      </div>
      <div class="col-md-12">
          <label for="nombre_ruta" class="form-label">Nombre de la Ruta</label>
          <input type="text" class="form-control" name="nombre_ruta" required='true'>
      </div>
      <div class="col-md-12">
      <label for="ciudad_origen" >Ciudad origen</label>
      <select class="form-control" name="ciudad_origen" onChange="combo(this, 'box')" >
                    <?php
                    $query="select * from ciudades";
                    $stmt=$conexion->prepare($query);
                    $stmt->execute();
                        while($row = $stmt ->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                            <option  selected="selected" ><?php echo $row['nombre_ciudad'];?></option>
                        <?php       
                        }
                        ?>
                    </select>

      </div>
      <div class="col-md-12">
      <label for="ciudad_destino" class="form-label">Ciudad destino</label>
      <select  class="form-control" name="ciudad_destino" onChange="combo(this, 'box')"  >
                    <?php
                    $query="select * from ciudades";
                    $stmt=$conexion->prepare($query);
                    $stmt->execute();
                        while($row = $stmt ->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                            <option  selected="selected" ><?php echo $row['nombre_ciudad'];?></option>
                        <?php       
                        }
                        ?>
                    </select>

      </div>
      <div class="col-md-12">
          <label for="tiempo_estimado" class="form-label">Tiempo estimado (minutos)</label>
          <input type="number" class="form-control" name="tiempo_estimado" required='true'>
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