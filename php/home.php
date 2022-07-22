<?php
    
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo'
        <script>
            alert("Por favor inicie sesión");
            window.location="index.php";
        </script>
        ';
        session_destroy();
        die();
    }

?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="../css/style_home.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../styles/styleinicio.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="Assets/FA/css/all.min.css"/>
        <link rel="stylesheet" href="Assets/css/footer.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Loop&display=swap" rel="stylesheet">

    </head>

    <body>
        
    
        <header>
            <div class="welcome">
            <h3>Bienvenid@ al sistema  <i><?php echo $_SESSION['login_user_sys'] ?></i></h3>
            </div>
            
            <div class="header__superior">
                <div class="logo">
                    <img src="../images/icono_coop_los_lagos.jpg">
                </div>
                <div class="direccion">
                    <h3>Coop. los lagos</h3>
                    <p>Otavalo...</p>
                </div>
            </div>
            
            <div class="container__menu">
                <div class="menu">
                    <input type="checkbox" id="check__menu">
                    <label id ="label__check" for="check__menu">
                        <i class="fa-solid fa-bars icono__menu"></i>
                    </label>
                    <nav>
                        <ul>
                           <li><a href="#" id="selector"></a></li>
                            <li><a href="#">Boletos</a>
                                <ul>
                                    <li><a href="factura/factura.php">Vender</a></li>
                                    <li><a href="#">Reporte</a></li>
                                </ul>
                            </li>
                            <li><a href="unidades/unidades.php">Unidades</a></li>
                            <li><a href="rutas/rutas.php">Rutas</a></li>
                            <li><a href="turnos/turnos.php">Turnos</a></li>
                            <li><a href="#">Más opciones</a>
                                <ul>
                                    <li><a href="#">Conductores</a></li>
                                    <li><a href="#">Ciudades</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        

        <main>
        <div id="mision">
            <h2 class="subtitulo__seccion">Misión</h2>
            <p class="contenido__seccion">Representar y defender el movimiento Cooperativo de la Provincia del Imbabura
                inicialmente,
                e impulsar políticas y estrategias en materia de promoción y planificación para su desarrollo
                que trasciendan en nuestro territorio Ecuatoriano.
            </p>
        </div>
        <div id="vision">
            <h2 class="subtitulo__seccion">Visión</h2>
            <p class="contenido__seccion">Ser la institución orientadora y promotora de los principios y valores
                cooperativos en la
                sociedad Ecuatoriana, y generar con ellos un esquema de desarrollo humano de manera sostenible, de alta
                competitividad
                productiva y laboral, y lograr ser el gran soporte Institucional que respalde cada día las actividades
                de los agremiados así como la de la Unión misma.
            </p>
        </div>
        <div id="ubicacion">
            <h2 class="subtitulo__seccion">Oficina matriz - Otavalo</h2>
            <p class="contenido__seccion">Avenida Atahualpa y Jacinto Collahuazo esquina</p>
            <iframe class="mapa"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7852184269723!2d-78.25994508517455!3d0.23339305984999106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e2a15c70245d817%3A0x9b54c86da4073e92!2sCOOPERATIVA%20DE%20TRANSPORTES%20OTAVALO!5e0!3m2!1ses!2sec!4v1656904719088!5m2!1ses!2sec"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <div id="galeria">
            <h2 class="subtitulo__seccion">Galeria:</h2>
            <div class="socios">
                <h3 class="socios-h3">Socios:</h3>
                <img class="socios__imagen" src="../images/imagenes_home/socioa.jpg"
                    alt="Socios">
                <p>Socios</p>
            </div>

            <div class="flota">
                <h3 class="flota-h3">Flota:</h3>
                <img class="flota-imagen" src="../images/imagenes_home/flota.jpg"
                    alt="flora">
                <p>Flota automotriz</p>
            </div>
            <div class="eventos">
                <h3 class="eventos-h3">Eventos:</h3>
                <img class="eventos-imagen" src="../images/imagenes_home/eventos.jpg" alt="eventos">
                <p>Eventos</p>

            </div>
            <div class="rutas">
                <h3 class="rutas-h3">Rutas:</h3>
                <img class="rutas-imagen" src="../images/imagenes_home/rutas.jpg" alt="rutas">
                <p>Rutas</p>
            </div>
    </main>
    <footer>
        <div class="footer-wrap">
            <div class="widgetFooter">
                <h4 class="uppercase">Cooperativa de Transportes <br> "Los Lagos" <br> Otavalo-Imbabura </h4>
                <ul id="footerUsefulLink">
                    <li title="About US">
                        <span class="usefulLinksIcons">
                            <i class="far fa-id-card"></i>
                        </span>
                        <h4 class="frase"> "Al servicio de la comunidad otavaleña..."</h4>
                    </li>
                    </li>
                    <li title="Contact Us">
                        <span class="usefulLinksIcons">
                            <i class="far fa-envelope"></i>
                        </span>
                        <a>&nbsp;Contáctenos</a>
                    </li>
                </ul>
            </div>
            <div class="widgetFooter" id="footerLogo">
            </div>
            <div class="widgetFooter">
                <h4 class="uppercase">Redes sociales</h4>
                <ul id="footerMediaLinks">
                    <li class="media1" title="Facebook">
                        <span class="mediaLinksIcons fb">
                            <i class="fab fa-facebook-square"></i>
                        </span>
                        <a class="fb">&nbsp;facebook</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footerCopy">
            <div class="inb">
                <p>Copyrights<sup>&copy;</sup> 2022. Desarrollado<i class="fas fa-heart" style="color: red;"></i> by
                    Universidad Técnica del Norte</p>
            </div>
        </div>
    </footer>
        
    </body>

</html>