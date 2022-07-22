<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo'
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" href="../../css/home.css">
        <style> 
                table tr th{
                    background:cadetblue;
                    color: azure;
                }
                tbody tr{
                font-size: 12px !important;
        
                }
                h3{
                    color:crimson; 
                    margin-top: 100px;
                }
                a:hover{
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
                    <label id ="label__check" for="check__menu">
                        <i class="fa-solid fa-bars icono__menu"></i>
                    </label>
                    <nav>
                        <ul>
                           <li><a href="../home.php" ></a></li>
                            <li><a href="#">Boletos</a>
                                <ul>
                                    <li><a href="../factura/factura.php">Vender</a></li>
                                    <li><a href="#">Reporte</a></li>
                                </ul>
                            </li>
                            <li><a href="../unidades/unidades.php">Unidades</a></li>
                            <li><a href="../rutas/rutas.php">Rutas</a></li>
                            <li><a href="turnos.php">Turnos</a></li>
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
            $conn=new Conexion();
            $conexion=$conn->Conectar();
            $QuerySelect   = "SELECT * FROM turnos";
            $stmt=$conexion->prepare($QuerySelect);
            $stmt->execute();
            $arrDatos=$stmt -> fetchAll();             
            $cantidad = count($arrDatos);
            ?>

            <div class="row" style="background-color: #cecece">
            <div class="col-md-6"> 
                <strong>Registrar Nuevo Turno</strong>
            </div>
            <div class="col-md-6"> 
                <strong style="margin:0px 50px ;">Lista de Turnos <span style="color: crimson">  ( <?php echo $cantidad; ?> )</span> </strong>
            </div>
            </div>

            <div class="row ">
            <div class="">
            <div class="body">
                <div class="row ">

                    <div class="col-sm-5">
                    <!--- Formulario para registrar Turno --->
                    <?php include('agregar_turno.php');  ?>
                    </div>  

                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-md-12">


                            <div class="">
                                <table class="table table-striped " id="tabla_turnos">
                                    <thead>
                                    <tr>
                                        <th >Id</th>
                                        <th >Ruta</th>
                                        <th >Unidad</th>
                                        <th >Precio</th>
                                        <th >Hora</th>
                                        <th >Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
 
                                    <?php
                                    $QuerySelect   = "SELECT * FROM turnos ";
                                    $stmt=$conexion->prepare($QuerySelect);
                                    $stmt->execute();
                                    while($dataTurno= $stmt ->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $dataTurno['id_turno']; ?></td>

                                        <?php
                                        $QuerySelect   = "SELECT nombre_ruta FROM rutas WHERE id_ruta='".$dataTurno['id_ruta']."'";
                                        $st=$conexion->prepare($QuerySelect);
                                        $st->execute();
                                        $nombre_rt=$st ->fetch(PDO::FETCH_ASSOC)
                                        ?>
                                        <td><?php echo $nombre_rt['nombre_ruta']; ?></td>


                                        <?php
                                        $QuerySelect   = "SELECT detalles FROM unidades WHERE id_unidad='".$dataTurno['id_unidad']."'";
                                        $stm=$conexion->prepare($QuerySelect);
                                        $stm->execute();
                                        $detalle_udd=$stm ->fetch(PDO::FETCH_ASSOC)
                                        ?>
                                        <td><?php echo $detalle_udd['detalles']; ?></td>

                                        <td><?php echo $dataTurno['precio']; ?></td>
                                        <td><?php echo $dataTurno['hora']; ?></td>
                                        
                                    <td> 
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteChildresn<?php echo $dataTurno['id_turno']; ?>">
                                            Eliminar
                                        </button>
                                        
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editChildresn<?php echo $dataTurno['id_turno']; ?>">
                                            Modificar
                                        </button>

                                    </td>

                                    </tr>
                                    <!--  Alerta de Eliminar--->
                                    <?php include('eliminar_turno.php');?>
                                    
                                    <!-- Actualizar--->
                                    <?php include('actualizar_turno.php');?>
                                    
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

            
            <!-- JQUERY -->
            <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
            </script>
            <!-- DATATABLES -->
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
            </script>
            <!-- BOOTSTRAP -->
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
            </script>
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
            <script>
                $(document).ready(function() {
                    $('#tabla_turnos').DataTable({
                        language: {
                            processing: "Tratamiento en curso...",
                            search: "Buscar&nbsp;:",
                            lengthMenu: "Agrupar de _MENU_ items",
                            info: " Mostrando _START_ - _END_ de _TOTAL_ ",
                            infoEmpty: "No existen datos.",
                            infoFiltered: "(filtrado de _MAX_ elementos en total)",
                            infoPostFix: "",
                            loadingRecords: "Cargando...",
                            zeroRecords: "No se encontraron datos con tu busqueda",
                            emptyTable: "No hay datos disponibles en la tabla.",
                            paginate: {
                                first: "Primero",
                                previous: "Anterior",
                                next: "Siguiente",
                                last: "Ultimo"
                            },
                            aria: {
                                sortAscending: ": active para ordenar la columna en orden ascendente",
                                sortDescending: ": active para ordenar la columna en orden descendente"
                            }
                        },
                        scrollY: 400,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Todo"]
                        ],
                    });
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function() {

                    $(window).load(function() {
                        $(".cargando").fadeOut(1000);
                    });

            //Ocultar mensaje
                setTimeout(function () {
                    $("#contenMsjs").fadeOut(1000);
                }, 3000);



                $('.btnBorrar').click(function(e){
                    e.preventDefault();
                    var id = $(this).attr("id");

                    var dataString = 'id='+ id;
                    url = "recibe_eliminar.php";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: dataString,
                            success: function(data)
                            {
                            window.location.href="turnos.php";
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