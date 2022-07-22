<?php
    include('../conexion_be.php');
    $con=new Conexion();
    $conexion=$con->Conectar();

    $id_unidad =  strtoupper(isset($_POST['id_unidad']) ? $_POST['id_unidad'] : '');    
    $id_conductor = isset($_POST['id_conductor']) ? $_POST['id_conductor'] : '';  
    $numero_asientos = isset($_POST['numero_asientos']) ? $_POST['numero_asientos'] : '';  
    $detalles= strtoupper(isset($_POST['detalles']) ? $_POST['detalles'] : '');  

    if($id_unidad!=''  && $id_conductor!= '' && $numero_asientos!='' && $detalles!='' ){ 
        
        $query="select * from unidades";
        $stmt=$conexion->prepare($query);
        $stmt->execute();
            while($dataUnidad = $stmt ->fetch(PDO::FETCH_ASSOC))
            {
                if(strcmp($id_conductor, $dataUnidad['id_conductor'])===0 && $id_unidad!=$dataUnidad['id_unidad']){
                    echo "<script type='text/javascript'>
                    alert('El conductor ya se encuentra registrado en la undiad ".$dataUnidad['id_unidad']."');
                    </script>";
                    echo "<script type='text/javascript'>
                    window.location='unidades.php';
                    </script>";
                    die();
                    exit;
                }
                
            }


        if((int)$numero_asientos<40 || (int)$numero_asientos>50 ){
            echo "<script type='text/javascript'>
            alert('El núemro de asientos se encuentra fuera del rango');
            </script>";
            echo "<script type='text/javascript'>
            window.location='unidades.php';
            </script>";
            die();
            exit;
        }else{

            $QueryUpdate = "UPDATE unidades 
            SET 
            id_conductor  ='" .$id_conductor. "',
            numero_asientos  ='" .$numero_asientos. "',
            detalles ='" .$detalles. "' 
            WHERE id_unidad='" .$id_unidad. "'";
            $st=$conexion->prepare($QueryUpdate);
            $st->execute();
            $st->closeCursor(); 
            $st = null;
            echo "<script type='text/javascript'>
                    window.location='unidades.php';
                </script>";
            die();
        }

    }else{
        echo "<script type='text/javascript'>
        alert('Existen campos vacios');
        </script>";
        echo "<script type='text/javascript'>
        window.location='rutas.php';
        </script>";
        die();
        exit;
    }

   

?>