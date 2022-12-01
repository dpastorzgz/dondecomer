<!DOCTYPE html>
<html lang="en">

<head>
    <title>DondeComerZGZ</title>
    <meta charset="utf-8">
    <meta name="description" content="Donde comer en Zaragoza">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="css/dondeComerLogo.jpg"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
</head>

<body>
    <?php 
        //Función para auto carga de clases siguiendo las buenas prácticas de programación
        spl_autoload_register(function ($clase) {
            require_once "classes/$clase.php";
            }
        );

        $db = new databaseAdmin($conexion);
        $listBBDD = $db->show_Databases();
        $elementos = sizeof($listBBDD) - 1;
    ?>
      
    <div class="container-fluid">
        <div class="row">
            <div class="caja-art col-sm-2 col-md-2 col-lg-2 hidden-xs text-center text-uppercase">
            <img class="iconocomer" src="/css/dondeComerLogo.jpg"/>
            </div>
            <div class="caja-art col-sm-10 col-md-10 col-lg-10 col-xs-10 text-center text-uppercase">
            <img class="iconotitulo" src="/css/dondeComerTitulo.png"/>    
            </div>
        </div>        

        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                    <h1>PANEL ADMINISTRACION</h1>
                </div>  
            </div>
        </section>        

        <div class="row">
            <fieldset class="fieldset">
                <legend>Datos de conexión</legend>
                
                <form action="/admin.php" method="POST">
                    <label for="host">Host</label>
                    <input type="text" name="host" value="localhost" id="" readonly="readonly">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" value="david" id="" readonly="readonly">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" value="qwerty" id="" readonly="readonly">
                </form>
            </fieldset>
        </div>   

        <br/>

        <div class="row">
            <fieldset class="fieldset">
                <legend>Bases de datos disponibles</legend>

                <form action="/tablas.php" method="post">
                    <?php
                        for ($n=0; $n<=$elementos;$n++) {
                            if ($n == 0 ) { ?>
                                <input type="radio" name="bbdd" checked value="<?= $listBBDD[$n] ?>"><?= $listBBDD[$n] ?><br>
                            <?php } else { ?>
                                <input type="radio" name="bbdd"  value="<?= $listBBDD[$n] ?>"><?= $listBBDD[$n] ?><br>
                        <?php } ?>
                    <?php }
                    ?>
                    <br/>
                    <input type="submit" name="enviar" value="Consultar base de datos">                    
                </form>
                <br/>
            </fieldset>   
        </div>                
    </div>

    <footer class="text-center text-lg-start bg-light text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <div class="me-5 d-none d-lg-block">
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                PROYECTO DAW
            </div>  
        </div>
    </section>

    <section class="">      
        <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3"></i>Nombre
            </h6>
            <p>
                David Pastor Puyuelo
            </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
                Tecnologías
            </h6>
            <p>
                <a href="https://www.php.net/manual/es/index.php" target="_blank" class="text-reset">PHP</a>
            </p>
            <p>
                <a href="https://www.mysql.com/" target="_blank" class="text-reset">MySQL</a>
            </p>
            <p>
                <a href="https://getbootstrap.com/" target="_blank" class="text-reset">Bootstrap</a>
            </p>
            </div>


            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
            <p>
                david.pastor.puyuelo@gmail.com
            </p>
            </div>
        </div>
        </div>
    </section>

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2022 Copyright
    </div>
    </footer>      
</body>
</html>