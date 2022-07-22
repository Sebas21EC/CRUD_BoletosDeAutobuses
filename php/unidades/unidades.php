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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rutas</title>
    <link rel="stylesheet" type="text/css" href="../../css/estilo_crud.css">
    
    <link rel="stylesheet" href="../../css/home.css">
    <style>
        table tr th {
            background: cadetblue;
            color: azure;
        }

        tbody tr {
            font-size: 12px !important;

        }

        h3 {
            color: crimson;
            margin-top: 100px;
        }

        a:hover {
            cursor: pointer;
            color: #333 !important;
        }
    </style>
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
                        <li><a href="#">Boletos</a>
                            <ul>
                                <li><a href="../factura/factura.php">Vender</a></li>
                                <li><a href="#">Reporte</a></li>
                            </ul>
                        </li>
                        <li><a href="unidades.php" id="selector">Unidades</a></li>
                        <li><a href="../rutas/rutas.php">Rutas</a></li>
                        <li><a href="../turnos/turnos.php">Turnos</a></li>
                        <li><a href="#">Más opciones</a>
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

    <main>
        <div class="container p-5">

            <?php

            include_once('../conexion_be.php');
            error_reporting(0);
            $conn = new Conexion();
            $conexion = $conn->Conectar();
            $QuerySelect   = "SELECT * FROM unidades ";
            $stmt = $conexion->prepare($QuerySelect);
            $stmt->execute();
            $arrDatos = $stmt->fetchAll();
            $cantidad = count($arrDatos);
            ?>

            <div class="row" style="background-color: #cecece">
                <div class="col-md-6">
                    <strong>Registrar Nueva Unidad</strong>
                </div>
                <div class="col-md-6">
                    <strong style="margin:0px 50px ;">Lista de Unidades <span style="color: crimson"> ( <?php echo $cantidad; ?> )</span> </strong>
                </div>
            </div>

            <div class="row ">
                <div class="">
                    <div class="body">
                        <div class="row ">

                            <div class="col-sm-5">
                                <!--- Formulario para registrar Cliente --->
                                <?php include('agregar_unidad.php');  ?>

                            </div>



                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-md-12">


                                        <div class="">
                                            <table class="table table-striped " id="tabla_unidades">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Id conductor</th>
                                                        <th>Número de asientos</th>
                                                        <th>Detalles</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $QuerySelect   = "SELECT * FROM unidades ";
                                                    $stmt = $conexion->prepare($QuerySelect);
                                                    $stmt->execute();
                                                    while ($dataUnidad = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <tr>
                                                            <td><?php echo $dataUnidad['id_unidad']; ?></td>
                                                            <td><?php echo $dataUnidad['id_conductor']; ?></td>
                                                            <td><?php echo $dataUnidad['numero_asientos']; ?></td>
                                                            <td><?php echo $dataUnidad['detalles']; ?></td>

                                                            <td>
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteChildresn<?php echo $dataUnidad['id_unidad']; ?>">
                                                                    Eliminar
                                                                </button>

                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editChildresn<?php echo $dataUnidad['id_unidad']; ?>">
                                                                    Modificar
                                                                </button>

                                                            </td>

                                                        </tr>
                                                        <!--  Alerta de Eliminar--->
                                                        <?php include('eliminar_unidad.php'); ?>

                                                        <!-- Actualizar--->
                                                        <?php include('actualizar_unidad.php'); ?>

                                                    <?php } ?>


                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>


            <script src="../../script/jquery.min.js"></script>
            <script src="../../script/pluggin.js"></script>

           

            <script type="text/javascript">
                $(document).ready(function() {

                    $(window).load(function() {
                        $(".cargando").fadeOut(1000);
                    });

                    //Ocultar mensaje
                    setTimeout(function() {
                        $("#contenMsjs").fadeOut(1000);
                    }, 3000);



                    $('.btnBorrar').click(function(e) {
                        e.preventDefault();
                        var id = $(this).attr("id");

                        var dataString = 'id=' + id;
                        url = "recibe_eliminar.php";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: dataString,
                            success: function(data) {
                                window.location.href = "unidades.php";
                                $('#respuesta').html(data);
                            }
                        });
                        return false;

                    });


                });
            </script>
    </main>
</body>

</html>