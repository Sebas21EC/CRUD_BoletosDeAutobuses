<?php

//echo "The email message was sent.";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggin Y registro - Sebas</title>
    <link rel="stylesheet" href="../css/loggin.css">
    <!-- <link rel="stylesheet" href="../css/modal.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>

<body>

    <div id="contenedor_error" style="display:none;">
        Contendor de error
    </div>

    <main>
        <div class="contenedor__todo">



            <div class="caja__trasera">
                <div class="caja__trasera-loggin">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia la sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>

                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse </button>
                </div>

            </div>

            <div class="contenedor__loggin-register">
                <form action="iniciar_sesion.php" method="post" class="formulario__loggin">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Usuario" name="user_sign_in">
                    <input type="password" placeholder="Contraseña" name="pass_sign_in">
                    <button>Entrar</button>
                </form>

                <form action="registro_usuario.php" method="post" class="formulario__register">

                    <h2>Registrarse</h2>
                    <input type="number" placeholder="Cédula/pasaporte" name="identificador">
                    <input type="text" placeholder="Nombre" name="nombre">
                    <input type="text" placeholder="Apellido" name="apellido">
                    <input type="text" placeholder="Usuario" name="usuario" id="id_user_sign_up">
                    <input type="password" placeholder="Contraseña" name="contrasenia">
                    <input type="email" placeholder="Email" name="email">
                    <input type="text" placeholder="Celular/Teléfono" name="telefono">
                    <select name="rol" onChange="combo(this, 'box')">
                        <option>Secretario/a</option>
                        <option>Administrador/a</option>
                        <option>Contador/a</option>
                    </select>

                    <div class="form-group">
                        <input type="button" id="Enviar" class="btn btn-primary  form-control" value="Guardar">
                    </div>
                    <div class="form-group">

                        <div id="resultado" style="background-color:#aaa;width:100%;" class=""></div>

                        <input type="button" class="btn btn-success" style="display:none;width:100%;" id="boton1" value="Limpiar">


                    </div>
                </form>

            </div>
            <div class="modal-container" id="modal_container">
                <div class="modal">
                    <h3>
                        Error
                    </h3>
                    <p id="mensaje_error">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                    <button id="btn_cerrar_modal">Cerrar</button>
                </div>
            </div>

        </div>


    </main>

    <script src="../script/loggin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../script/ajax.js"></script>

</body>

</html>