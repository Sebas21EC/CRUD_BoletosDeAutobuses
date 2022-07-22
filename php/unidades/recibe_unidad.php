<?php
    include('../conexion_be.php');
    $conn=new Conexion();
    $conexion=$conn->Conectar();
    $id_unidad     =  strtoupper(isset($_POST['id_unidad']) ? $_POST['id_unidad'] : '');    
    $id_conductor 	 = isset($_POST['id_conductor']) ? $_POST['id_conductor'] : '';  
    $numero_asientos 	 = isset($_POST['numero_asientos']) ? $_POST['numero_asientos'] : '';  
    $detalles=  strtoupper(isset($_POST['detalles']) ? $_POST['detalles'] : '');  

    if(preg_match("/^[a-zA-Z]{3}-[1-9]{3,4}$/",$id_unidad)!=1){
        echo "<script type='text/javascript'>
        alert('Ingrese una placa valida, ejemplo XXX-9999');
        </script>";
        echo "<script type='text/javascript'>
        window.location='unidades.php';
        </script>";
        die();
        exit;
    }

    $query="select * from unidades";
    $stmt=$conexion->prepare($query);
    $stmt->execute();
    while($dataUnidad = $stmt ->fetch(PDO::FETCH_ASSOC))
    {
        if(strcmp($id_unidad, $dataUnidad['id_unidad'])===0){
            echo "<script type='text/javascript'>
            alert('La unidad $id_unidad ya se encuentra registrada.');
            </script>";
            echo "<script type='text/javascript'>
            window.location='unidades.php';
            </script>";
            die();
            exit;
    
        }

        if(strcmp($id_conductor, $dataUnidad['id_conductor'])===0){
            echo "<script type='text/javascript'>
            alert('El conductor ya se encuentra registrado en la unidad ".$dataUnidad['id_unidad']."');
            </script>";
            echo "<script type='text/javascript'>
            window.location='unidades.php';
            </script>";
            $stmt->closeCursor(); 
            $stmt = null; 
            die();
            exit;
        }

        
    }



    if((int)$numero_asientos<40 || (int)$numero_asientos>50 ){
        echo "<script type='text/javascript'>
        alert('El número de asientos se encuentra fuera del rango');
        </script>";
        echo "<script type='text/javascript'>
        window.location='unidades.php';
        </script>";
        die();
        exit;
    }

    $QueryInsert = "INSERT INTO unidades(id_unidad, id_conductor, numero_asientos, detalles)
    VALUES (
        '".$id_unidad. "',
        '".$id_conductor. "',
        '".$numero_asientos."',
        '".$detalles."'
    )";
    $stmt=$conexion->prepare($QueryInsert);
    $stmt->execute();
    $stmt->closeCursor(); 
    $stmt = null; 
    header("location:unidades.php");
?>