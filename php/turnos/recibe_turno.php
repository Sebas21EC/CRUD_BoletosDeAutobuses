<?php
    include('../conexion_be.php');
    $conn=new Conexion();
    $conexion=$conn->Conectar();

    $id_turno =strtoupper(isset($_POST['id_turno']) ? $_POST['id_turno'] : '');   
    $ruta=isset($_POST['ruta']) ? $_POST['ruta'] : ''; 
    $id_ruta =substr( $ruta,0,strpos($ruta,":")); 
    $unidad=isset($_POST['unidad']) ? $_POST['unidad'] : ''; 
    $id_unidad = substr( $unidad,0,strpos($unidad,":")); 
    $precio =isset($_POST['precio']) ? $_POST['precio'] : ''; 
    $hora=  strtoupper(isset($_POST['hora']) ? $_POST['hora'] : '');  



    $query="SELECT * FROM turnos WHERE  id_turno='$id_turno'";
    $stm=$conexion->prepare($query);
    $stm->execute();
    $arrDatos=$stm -> fetchAll();             
    $cantidad = count($arrDatos);
    if((int)$cantidad>0){
        echo "<script type='text/javascript'>
        alert('El el identificador $id_turno ya existe');
        </script>";
        echo "<script type='text/javascript'>
        window.location='turnos.php';
        </script>";
        die();
        exit;
    }

    if(substr($hora,0,strpos($hora,":"))<3 ||substr($hora,0,strpos($hora,":"))<20){
        echo "<script type='text/javascript'>
        alert('El horario de servicio es de 3 am hasta 7 pm');
        </script>";
        echo "<script type='text/javascript'>
        window.location='turnos.php';
        </script>";
        die();
        exit;
    }


    $query="SELECT * FROM turnos WHERE  id_unidad='$id_unidad' AND hora='$hora'";
    $stmt=$conexion->prepare($query);
    $stmt->execute();
    $arrDatos=$stmt -> fetchAll();             
    $cantidad = count($arrDatos);
    if((int)$cantidad>0){
        echo "<script type='text/javascript'>
        alert('Le informamos que la unida $unidad ya registra una ruta en el horario de $hora');
        </script>";
        echo "<script type='text/javascript'>
        window.location='turnos.php';
        </script>";
        die();
        exit;
    }
   
    $A= (float)$precio;
    if($A>10 || $A<0.35 ){
        echo "<script type='text/javascript'>
        alert('Ingrese un valor coherente para el precio');
        </script>";
        echo "<script type='text/javascript'>
        window.location='turnos.php';
        </script>";
        die();
        exit;
       
    }

    $QueryInsert = "INSERT INTO turnos(id_turno, id_ruta,id_unidad , precio,hora)
    VALUES (
        '".$id_turno. "',
        '".$id_ruta. "',
        '".$id_unidad. "',
        '".str_replace(".",",",$precio)."',
        '".$hora."'
    )";
    $stmt=$conexion->prepare($QueryInsert);
    $stmt->execute();
    $stmt->closeCursor(); 
    $stmt = null; 
    header("location:turnos.php");
?>