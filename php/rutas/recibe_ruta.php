<?php
include('../conexion_be.php');
error_reporting(0);
$conn=new Conexion();
$conexion=$conn->Conectar();
$id_ruta     =  isset($_POST['id_ruta']) ? $_POST['id_ruta'] : '';    
$nombre_ruta 	 = isset($_POST['nombre_ruta']) ? $_POST['nombre_ruta'] : '';  
$ciudad_origen 	 = isset($_POST['ciudad_origen']) ? $_POST['ciudad_origen'] : '';  
$ciudad_destino	 = isset($_POST['ciudad_destino']) ? $_POST['ciudad_destino'] : ''; 
$tiempo_estimado	 = isset($_POST['tiempo_estimado']) ? $_POST['tiempo_estimado'] : ''; 

$QuerySelect   = "SELECT * FROM rutas ";
$stmt=$conexion->prepare($QuerySelect);
$stmt->execute();
while($dataRuta = $stmt ->fetch(PDO::FETCH_ASSOC)) {
    if($id_ruta==$dataRuta['id_ruta']){
        echo "<script type='text/javascript'>
        alert('El identificador de la ruta ya existe en la base de datos.');
        </script>";
        echo "<script type='text/javascript'>
        window.location='rutas.php';
        </script>";
        die();
        exit;

    }
}



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



$QueryInsert = "INSERT INTO rutas(id_ruta, nombre_ruta, ciudad_salida, ciudad_destino, tiempo_estimado)
VALUES (
    '".$id_ruta. "',
    '".$nombre_ruta. "',
    '".$ciudad_origen."',
    '".$ciudad_destino."',
    '".$tiempo_estimado."'
)";
$stmt=$conexion->prepare($QueryInsert);
$stmt->execute();

$stmt->closeCursor(); 
$stmt = null; 
header("location:rutas.php");

?>