<?php

class Conexion{
    public function Conectar(){
        define('HOST','localhost');
        define('PORT','1521');
        define('NAME','XE');
        define('USER','SEBAS');
        define('PASS','Evesitha2020');

        $bd_settings="
        (DESCRIPTION = 
            (ADDRESS = (PROTOCOL = TCP)(HOST = " . HOST . ") (PORT = " . PORT . "))
            (CONNECT_DATA = 
                (SERVER = DEDICATED)
                (SERVICE_NAME = " . NAME . ")
            )
        )
        ";

        try {

            $bd= new PDO('oci:dbname='.$bd_settings, USER, PASS);
            $bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'conexion exitosa';
            return $bd;
        } catch (Exception $e){

            echo 'ERROR...'.$e->getMessage();
        }
        
    }
    
}



?>