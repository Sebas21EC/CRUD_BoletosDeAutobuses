<?php
include('../conexion_be.php');
$conn=new Conexion();
$conexion=$conn->Conectar();

$id_turno = $_REQUEST['id'];
$DeleteRegistro = "DELETE FROM turnos WHERE id_turno= '".$id_turno."'";

$st=$conexion->prepare($DeleteRegistro);
$st->execute();
$st->closeCursor(); 
$st = null;


?>