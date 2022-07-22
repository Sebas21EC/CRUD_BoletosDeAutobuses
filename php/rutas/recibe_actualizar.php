<?php
    include('../conexion_be.php');
    $con=new Conexion();
    $conexion=$con->Conectar();

    $id_ruta     =  isset($_POST['id_ruta']) ? $_POST['id_ruta'] : '';    
    $nombre_ruta 	 = isset($_POST['nombre_ruta']) ? $_POST['nombre_ruta'] : '';  
    $ciudad_origen 	 = isset($_POST['ciudad_origen']) ? $_POST['ciudad_origen'] : '';  
    $ciudad_destino	 = isset($_POST['ciudad_destino']) ? $_POST['ciudad_destino'] : ''; 
    $tiempo_estimado	 = isset($_POST['tiempo_estimado']) ? $_POST['tiempo_estimado'] : '';  


    if(strcmp($ciudad_origen, $ciudad_destino)===0){
        echo "<script type='text/javascript'>
        alert('La ciudad de origen y de destino no deben coincidir');
        </script>";
        echo "<script type='text/javascript'>
        window.location='rutas.php';
        </script>";
        die();
        exit;

    }

    if((int)$tiempo_estimado<10 ||(int)$tiempo_estimado>2000){
        echo "<script type='text/javascript'>
        alert('Asegúrese de ingresar un tiempo prudente');
        </script>";
        echo "<script type='text/javascript'>
        window.location='rutas.php';
        </script>";
        die();
        exit;
    }

    $QueryUpdate = "UPDATE rutas 
    SET 
    nombre_ruta  ='" .$nombre_ruta. "',
    ciudad_salida  ='" .$ciudad_origen. "',
    ciudad_destino ='" .$ciudad_destino. "',
    tiempo_estimado='".$tiempo_estimado."'

    WHERE id_ruta='" .$id_ruta. "'";
    $st=$conexion->prepare($QueryUpdate);
    $st->execute();

    echo "<script type='text/javascript'>
            window.location='rutas.php';
        </script>";
    $mensaje = "Actualización Exitosa";
    $st->closeCursor(); 
    $st = null;
    

       

?>