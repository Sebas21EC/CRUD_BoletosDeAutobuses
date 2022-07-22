<?php
require_once('../conexion_be.php');
$conn = new Conexion();
$conexion = $conn->Conectar();

?>
<form name="form-data" action="recibe_turno.php" method="POST">

    <div class="row">
        <div class="col-md-12">
            <label for="recipient-name">ID turno: </label>
            <input type="text" class="form-control" name="id_turno" required='true' autofocus>
        </div>

        <div class="col-md-12">
            <label for="recipient-name">Ruta: </label>
            <select class="form-control" name="ruta" onChange="combo(this, 'box')">
                <?php
                $query = "select * from rutas";
                $stmt = $conexion->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option><?php echo $row['id_ruta']; ?>: <?php echo $row['nombre_ruta']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="recipient-name">Unidad: </label>
            <select class="form-control" name="unidad" onChange="combo(this, 'box')">
                <?php
                $query = "select * from unidades";
                $stmt = $conexion->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option><?php echo $row['id_unidad']; ?>: <?php echo $row['detalles']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>


        <div class="col-md-12">
            <label for="recipient-name">Precio: </label>
            <input type="number" step="0.01" class="form-control" name="precio" required='true' autofocus>
        </div>

        <div class="col-md-12">
            <label for="recipient-name">Hora: </label>
            <input type="time" class="form-control" name="hora" required='true' autofocus>
        </div>

    </div>
    <div class="row ">
        <div class="col-12">
            <button class="btn btn-primary btn-block" id="btnEnviar">
                Agregar Turno
            </button>
        </div>
    </div>
</form>