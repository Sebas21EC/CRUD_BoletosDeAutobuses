<?php
include('../conexion_be.php');
$conn=new Conexion();
$conexion=$conn->Conectar();

$id_turno = $_REQUEST['id'];

$DeleteRegistro = "DELETE FROM rutas WHERE id_ruta= '".$id_turno."'";

$st=$conexion->prepare($DeleteRegistro);
$st->execute();

$st->closeCursor(); 
$st = null;


?>