
<?php


     try{
    session_start();
    require_once('conexion_be.php');
    require_once('index.php');
    $conexion = new Conexion();
    $getConexion = $conexion->Conectar();
    $usuario= isset($_POST['user_sign_in']) ? $_POST['user_sign_in'] : ''; 
    $contrasenia= isset($_POST['pass_sign_in']) ? $_POST['pass_sign_in'] :  ''; 

        //VER SI EXIET EL USUARIO
        $verificar_usuario="select * from usuarios where usuario='$usuario'";
        $stmt=$getConexion->prepare($verificar_usuario);
        $stmt->execute();
        $arrDatos=$stmt -> fetchAll();
        $numero_filas = count($arrDatos);
        
        if($numero_filas>0){
            
        $verificar_usuario="select nombre,apellido, usuario, contrasenia from usuarios where usuario='$usuario'";
        $stmt=$getConexion->prepare($verificar_usuario);
        $stmt->execute();
        $valor=$stmt->fetch(PDO::FETCH_ASSOC);
        if(strcasecmp($valor["usuario"], $usuario) == 0){
            
            $contrasenia=hash('sha512',$contrasenia);
             if(strcasecmp($valor["contrasenia"], $contrasenia)==0){
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['login_user_sys']=$valor["nombre"]." ".$valor["apellido"];
                header("location:home.php");
                $estado=false;
                exit;
             }else{

                    
                 ?>
                <script>
                let contenedor = document.getElementById("modal_container");
                contenedor.style.display="flex";
                document.getElementById('mensaje_error').innerHTML="Usuario/contraseña son incorrectos ";
                </script>';
                <?php
                exit;
                die();
             }                  
            }
        }else{
                
                 ?>
                <script>
                 let contenedor = document.getElementById("modal_container");
                contenedor.style.display="flex";
                document.getElementById('mensaje_error').innerHTML="Usuario/contraseña son incorrectos ";
                </script>';
                <?php
                exit;
                die();
        }
     }catch(Exception $e){
        session_start();
        if(!isset($_SESSION['usuario'])){
            echo'
            <script>
                window.location="index.php";
            </script>
            ';
            session_destroy();
            die();
        }
        session_destroy();
     }



?>
