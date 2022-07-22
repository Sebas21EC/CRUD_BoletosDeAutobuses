<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor inicie sesión");
            window.location="../index.php";
        </script>
        ';
    session_destroy();
    die();
}
$cliente = "";
$remitente = $_SESSION['login_user_sys'];
$mensajePie = "Gracias por su compra";
$numero = 1;
$porcentajeImpuestos = 16;
$fecha = date("d-m-Y");
include('../conexion_be.php');
$con = new Conexion();
$conexion = $con->Conectar();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="./bs3.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilo_crud.css">
    <script src="../../script/html2pdf.bundle.min.js"></script>

</head>

<body>
    <header>


        <div class="header__superior">
            <div class="logo">
                <img src="../../images/icono_coop_los_lagos.jpg">
            </div>
            <div class="direccion">
                <h3>Coop. los lagos</h3>
                <p>Otavalo...</p>
            </div>
        </div>

        <div class="container__menu">
            <div class="menu">
                <input type="checkbox" id="check__menu">
                <label id="label__check" for="check__menu">
                    <i class="fa-solid fa-bars icono__menu"></i>
                </label>
                <nav>
                    <ul>
                        <li><a href="../home.php"></a></li>
                        <li><a href="#" id="selector">Boletos</a>
                            <ul>
                                <li><a href="factura.php" id="selector">Vender</a></li>
                                <li><a href="#">Reporte</a></li>
                            </ul>
                        </li>
                        <li><a href="../unidades/unidades.php">Unidades</a></li>
                        <li><a href="../rutas/rutas.php">Rutas</a></li>
                        <li><a href="../turnos/turnos.php">Turnos</a></li>
                        <li><a href="#">Más Opciones</a>
                            <ul>
                                <li><a href="#">Conductores</a></li>
                                <li><a href="#">Ciudades</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


    <div class="container" style="margin-top: 180px;">
        <div class="row">
            <div>
                <h2>Factura</h2>
            </div>
            <div class="col-xs-2">

            </div>
        </div>
        <hr>
        <div class="row">
            <strong>Fecha</strong>
            <br>
            <?php echo $fecha ?>
            <br>
            <strong>Factura No.</strong>
            <br>
            <?php echo $numero ?>

        </div>
        <hr>
        <div class="row" style="margin-bottom: 2rem; justify-content: center; align-items: center;">
            <div style="display: flex;">

                <form action="" method="post">
                    <div>
                        <h3>Datos del cliente</h3>
                        <label form="id_cliente">Identificación</label>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <input type="number" class="form-control" style="width:200px;" placeholder="Id cliente" name="id_cliente" value="9999999999" required=true autofocus>

                        </div>
                    </div>

                    <?php
                    $query = "select * from clientes where id_cliente='" . (isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '') . "'";
                    $st = $conexion->prepare($query);
                    $st->execute();
                    while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <label form="nombre_cliente">Cliente</label>
                            <input type="text" class="form-control" style="width:200px;" placeholder="Nombre cliente" name="nombre_cliente" value="<?php echo $row['nombre']; ?> <?php echo $row['apellido']; ?>" required=true autofocus>
                            <label form="nombre_cliente">Teléfono</label>
                            <input type="text" class="form-control" style="width:200px;" placeholder="Teléfono cliente" name="telefono_cliente" value="<?php echo $row['telefono'] ?>" required=true autofocus>
                            <label form="nombre_cliente">Direccion</label>
                            <input type="text" class="form-control" style="width:200px;" placeholder="Dirección cliente" name="telefono_cliente" value="<?php echo $row['direccion'] ?>" required=true autofocus>
                        </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <div>

                        <h3>Datos de boleto</h3>
                        <label for="numero_boletos">Número de boletos</label>
                        <input type="number" class="form-control" placeholder="Número de boletos" value="1" name="numero_boletos" required=true autofocus>
                    </div>
                    <select class="form-control" name="turno" onChange="combo(this, 'box')">
                        <?php
                        $query = "select * from turnos";
                        $stmt = $conexion->prepare($query);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $QuerySelect   = "SELECT nombre_ruta FROM rutas WHERE id_ruta='" . $row['id_ruta'] . "'";
                            $st = $conexion->prepare($QuerySelect);
                            $st->execute();
                            $nombre_rt = $st->fetch(PDO::FETCH_ASSOC);

                            $QuerySelect   = "SELECT detalles FROM unidades WHERE id_unidad='" . $row['id_unidad'] . "'";
                            $stm = $conexion->prepare($QuerySelect);
                            $stm->execute();
                            $detalle_udd = $stm->fetch(PDO::FETCH_ASSOC)
                        ?>
                            <option><?php echo $row['id_turno']; ?>: <?php echo $nombre_rt['nombre_ruta']; ?> - <?php echo $detalle_udd['detalles']; ?></option>
                        <?php
                        }

                        ?>
                    </select>

                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <?php
                        $id_turno = substr(isset($_POST['turno']) ? $_POST['turno'] : '', 0, strpos(isset($_POST['turno']) ? $_POST['turno'] : '', ":"));
                        $query = "select * from turnos where id_turno='$id_turno'";
                        $stm = $conexion->prepare($query);
                        $stm->execute();
                        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div style="display: flex; flex-direction: row; align-items: center;">
                                <label form="id_turno">Id turno</label>
                                <input type="text" class="form-control" style="width:200px;" placeholder="Id Ruta" name="id_turno" value="<?php echo $row['id_turno']; ?>" required=true autofocus>
                                <?php

                                $QuerySelect   = "SELECT nombre_ruta FROM rutas WHERE id_ruta='" . $row['id_ruta'] . "'";
                                $st = $conexion->prepare($QuerySelect);
                                $st->execute();
                                $nombre_rt = $st->fetch(PDO::FETCH_ASSOC); ?>
                                <label form="nombre_ruta">Nombre de ruta</label>
                                <input type="text" class="form-control" style="width:200px;" placeholder="Nombre ruta" name="nombre_ruta" value="<?php echo $nombre_rt['nombre_ruta'] ?>" required=true autofocus>
                            </div>
                            <div >
                                <label form="hora">Hora</label>
                                <input type="text" class="form-control" style="width:200px;" placeholder="Hora" name="hora" value="<?php echo $row['hora'] ?>" required=true autofocus>
                                <label form="precio">Precio</label>
                                <input type="text" class="form-control" style="width:200px;" placeholder="Precio" name="precio" value="<?php echo $row['precio'] ?>" required=true autofocus>

                            </div>

                        <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="form-control" style="width:200px;">Cargar</button>
                    <?php
                    $precio = "0" . str_replace(",", ".", isset($_POST['precio']) ? $_POST['precio'] : '');
                    $turno = [
                        [
                            "precio" =>  $precio,
                            "descripcion" => isset($_POST['nombre_ruta']) ? $_POST['nombre_ruta'] : '---',
                            "cantidad" => (int)isset($_POST['numero_boletos']) ? $_POST['numero_boletos'] : ''
                        ]
                    ];
                    ?>
                </form>


            </div>

            <div class="col-sm-6">
                <p><b>Remitente:</b> <?php echo $remitente ?></p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Turno</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subtotal = 0;
                        foreach ($turno as $turnos) {
                            $totalVenta = $turnos["cantidad"] * $turnos["precio"];
                            $subtotal += $totalVenta;
                        ?>
                            <tr>
                                <td><?php echo $turnos["descripcion"] ?></td>
                                <td><?php echo number_format($turnos["cantidad"], 2) ?></td>
                                <td>$<?php echo number_format($turnos["precio"], 2) ?></td>
                                <td>$<?php echo number_format($totalVenta, 2) ?></td>
                            </tr>
                        <?php }
                        $total = $subtotal;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">
                                <h4>Total</h4>
                            </td>
                            <td>
                                <h4>$<?php echo number_format($total, 2) ?></h4>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>



    </div>

    <div style="display: flex; align-items: center; justify-content: center;">
        <button style="background-color: cyan;" class="form-control" id="btn_crear_pdf">Imprimir Factura</button>
    </div>
    <script src="../../script/jquery.min.js"></script>
    <script src="../../script/pluggin.js"></script>
    <script src="../../script/html2pdf.bundle.min.js"></script>
    <script src="../../script/imprimir.js"></script>


</body>

</html>