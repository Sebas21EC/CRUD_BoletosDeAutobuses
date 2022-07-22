
<?php

    try{
        require_once('conexion_be.php');
        include_once("index.php");   
        
        $conexion = new Conexion();
        $getConexion = $conexion->Conectar();
        $identificador= isset($_POST['identificador']) ? $_POST['identificador'] : '';  
        $nombre=  isset($_POST['nombre']) ? $_POST['nombre'] : '';    
        $apellido=isset($_POST['apellido']) ? $_POST['apellido'] : '';        
        $usuario=isset($_POST['usuario']) ? $_POST['usuario'] : '';    
        $contrasenia=isset($_POST['contrasenia']) ? $_POST['contrasenia'] : '';     
        
        $email= isset($_POST['email']) ? $_POST['email'] : ''; 
        $telefono=isset($_POST['telefono']) ? $_POST['telefono'] : '';   
        $rol=isset($_POST['rol']) ? $_POST['rol'] : '';

        if($identificador=="" || $nombre=="" || $apellido=="" || $usuario=="" || $contrasenia=="" || $email=="" || $telefono==""){
            ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="No debe haber campos vacios";
           </script>';
           <?php
           die();
        }
        

        
        if(strlen($identificador)!=10){
            ?>
             <script>
            let contenedor = document.getElementById("modal_container");
            contenedor.style.display="flex";
            document.getElementById('mensaje_error').innerHTML="El numero de cédula debe contener 10 dígitos";
            </script>';
            <?php
            die();
        }

        if(strlen($usuario)<6){
             ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="El usuario debe contener mínimo 6 caracteres";
           </script>';
           <?php
           die();
        }
        if(strlen($contrasenia)<6){
             ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="La contraseña debe contener mínimo 6 caracteres";
           </script>';
           <?php
           die();
        }  else{
            $contrasenia=hash('sha512',$contrasenia);$contrasenia=hash('sha512',$contrasenia);
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
             ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="El email no es válido";
           </script>';
           <?php
           die();
        }
        
        
        if(strlen($telefono)!=10){
            ?>
             <script>
            let contenedor = document.getElementById("modal_container");
            contenedor.style.display="flex";
            document.getElementById('mensaje_error').innerHTML="El número telefónico debe contener 10 dígitos";
            </script>';
            <?php
            die();
        }
        
        
        
        function ValidarCedula($digitos)
        {
            $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);
            $digitosIniciales = [];
            $as = str_split($digitos);;
            for ($x = 0; $x < count($as)-1; $x++) {
                $digitosIniciales[] = $as[$x];
            }
            
            $digitoVerificador = (int)$as[9];
            $total = 0;
            foreach ($digitosIniciales as $key => $value) {
    
                $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
    
                if ($valorPosicion >= 10) {
                    $valorPosicion = str_split($valorPosicion);
                    $valorPosicion = array_sum($valorPosicion);
                    $valorPosicion = (int)$valorPosicion;
                }
    
                $total = $total + $valorPosicion;
            }
    
            $residuo =  $total % 10;
    
            if ($residuo == 0) {
                $resultado = 0;
            } else {
                $resultado = 10 - $residuo;
            }
            if ($resultado != $digitoVerificador) {
                
                ?>
                <script>
                let contenedor = document.getElementById("modal_container");
                contenedor.style.display="flex";
                document.getElementById('mensaje_error').innerHTML="La cédula ingresada no es válida. ";
                </script>';
                <?php
                exit;
                die();
            }
    
        }
       
        ValidarCedula($identificador);


        if(preg_match("/^[a-zA-Z ñÑ]+$/",$nombre)!=1 ){
            ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="El nombre ingresado no es válido";
           </script>';
           <?php
           die();
        }
        
        if(preg_match("/^[a-zA-Z nÑ]+$/",$apellido)!=1 ){
            ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="El nombre ingresado no es válido";
           </script>';
           <?php
           die();
        }
        
        if(preg_match("/^0[1-9]{9}+$/",$telefono)!=1 ){
            ?>
            <script>
           let contenedor = document.getElementById("modal_container");
           contenedor.style.display="flex";
           document.getElementById('mensaje_error').innerHTML="El numero telefónico ingresado no es válido";
           </script>';
           <?php
           die();
        }
        
        
        //VER SI EXIET EL identificador
        $verificar_identificador="select * from usuarios where id_usuario='$identificador'";
        $stmt=$getConexion->prepare($verificar_identificador);
        $stmt->execute();
        $arrDatos=$stmt -> fetchAll();             
        $numero_filas = count($arrDatos);
        if($numero_filas>0){
            ?>
            <script>
            let contenedor = document.getElementById("modal_container");
            contenedor.style.display="flex";
            document.getElementById('mensaje_error').innerHTML="Ya existe un usuario con este identificador.";
            </script>';
            <?php
            die();
        }
        
        
        //VER SI EXIET EL USUARIO
        $verificar_usuario="select * from usuario where usuario='$usuario'";
        $stmt=$getConexion->prepare($verificar_usuario);
        $stmt->execute();
        $arrDatos=$stmt -> fetchAll();             
        $numero_filas = count($arrDatos);
        
        if($numero_filas>0){
            ?>
             <script>
            let contenedor = document.getElementById("modal_container");
            contenedor.style.display="flex";
            document.getElementById('mensaje_error').innerHTML="Ya existe este usuario";
            </script>';
            <?php
            die();
        }
        
        //VER SI EXISTE EL CORREO
        $verificar_correo="select * from usuarios where correo='$email'";
        $stmt=$getConexion->prepare($verificar_correo);
        $stmt->execute();
        $arrDatos=$stmt -> fetchAll();             
        $numero_filas = count($arrDatos);
        if($numero_filas>0){
            ?>
             <script>
            let contenedor = document.getElementById("modal_container");
            contenedor.style.display="flex";
            document.getElementById('mensaje_error').innerHTML="Ya existe un usuario con el correo ingresado";
            </script>';
            <?php
            die();
        }
        
        $query="INSERT INTO USUARIOS(ID_USUARIO, NOMBRE, APELLIDO, USUARIO, CONTRASENIA, CORREO, TELEFONO, ROL) VALUES ('$identificador','$nombre','$apellido','$usuario','$contrasenia','$email','$telefono','$rol')";
        $stmt=$getConexion->prepare($query);
        $stmt->execute();
        ?>
        <?php
         include("index.php");   
         ?>
        <script>
        let contenedor = document.getElementById("contenedor_error");
        contenedor.style.display="block";
        contenedor.style.backgroundColor="rgba(0,243,8,0.5)";
        contenedor.innerHTML = "Registro exitoso.";
        </script>';
        <?php
        exit;
        die();
        
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