<?php
include('../conexion_be.php');
$conn=new Conexion();
$conexion=$conn->Conectar();

$id_unidad = $_REQUEST['id'];

$DeleteRegistro = "DELETE FROM unidades WHERE id_unidad= '".$id_unidad."'";

$st=$conexion->prepare($DeleteRegistro);
$st->execute();

$st->closeCursor(); 
$st = null;


?>