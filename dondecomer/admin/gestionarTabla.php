<!DOCTYPE html>
<html lang="en">

<head>
    <title>DondeComerZGZ</title>
    <meta charset="utf-8">
    <meta name="description" content="Donde comer en Zaragoza">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/dondeComerLogo.jpg"> 

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet"> 
</head>

<body>
    <?php 
        //Función para auto carga de clases siguiendo las buenas prácticas de programación
        spl_autoload_register(function ($clase) {
            require_once "../classes/$clase.php";
            }
        );

        session_start();

        $db = new databaseAdmin();
        
        if (isset($_POST['consultar'])) {
            $tabla = $_POST['tabla'];
            $_SESSION['tabla'] = $tabla;
        } else
            $tabla = $_SESSION['tabla'];
        
        if ($tabla != '') {
            $campos = $db->campos($tabla);
            $_SESSION['campos'] = $campos;
            $sentencia = 'SELECT * FROM ' . $tabla;
            $filas = $db->seleccionar($sentencia);
        }
        
        if (isset($_POST['submit'])) {
            switch ($_POST['submit']) {
                case 'Nuevo':
                    header("Location:/admin/insertar.php");
                    break;
                case 'Editar':
                    $param = '';
                    $num = 0;
                    foreach ($campos as $campo) {
                        $var = $_POST["$num"];
                        $param = $param  . "&" . $campo . "=" .$var;
                        $num++;
                    }
                    $header = "Location:/admin/editar.php?" . $param;
                    header($header);
                    break;
                case 'Borrar':
                    $parametros = [];
                    $sentencia = "DELETE FROM " . $tabla . " Where ";
                    $param = '';
                    $num = 0;
                    $contadorParam = 0;
                    foreach ($campos as $campo) {
                        if ($contadorParam != 0) {
                            $param = $param  . " AND ";
                        }
                        $var = $_POST["$num"];
                        $param = $param  . " " . $campo . "=?";
                        $parametros [] = $var;
                        $num++;
                        $contadorParam++; 
                    }
                    $sentencia = $sentencia . $param;
                    $db->ejecutarSentencia($sentencia,$parametros);
                    $sentencia = 'SELECT * FROM ' . $tabla;
                    $filas = $db->seleccionar($sentencia);
                    break;
                case 'Volver':
                    $db->cerrarDB();
                    header("Location:/admin/tablas.php");
                    break;
            }
        }        
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
                
                <form action="/admin/tablas.php" method="POST">
                    <label for="host">Host</label>
                    <input type="text" name="host" value="localhost" id="" readonly="readonly">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" value="david" id="" readonly="readonly">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" value="qwerty" id="" readonly="readonly">
                    <input type="submit" value="Volver" name="volver">
                </form>
            </fieldset>
        </div>   
        <br/>

        <div class ="row">

        <fieldset class="fieldset">
            <legend>Admnistración de la tabla <?php echo $tabla; ?></legend>
            <?= $msj ?? null?>
            <table id="tabla" class="display" border="1">
                <thead>
                <tr>
                <?php
                    foreach ($campos as $campo) {  ?>
                        <th><?= $campo ?> </th>
                <?php
                    }
                ?>
                <th colspan="2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $fila = $filas->fetch(PDO::FETCH_NUM);
                    while ($fila) { ?>
                <tr>
                    <form action='/admin/gestionarTabla.php' method='post'>

                        <?php
                        $n = 0;
                        foreach ($fila as $valor) {  ?>
                            <td> <?= $valor ?> </td>
                            <input type="hidden" value="<?= $valor ?>" name="<?= $n ?>">


                        <?php $n++;} ?>

                        <input type="hidden" value="<?= $n ?>" name="numCampos">
                        <td><input id=tabla type="submit" value="Editar" name="submit"></td>
                        <td><input id=tabla type="submit" value="Borrar" name="submit"></td>
                    </form>
                </tr>
                <?php
                $fila = $filas->fetch(PDO::FETCH_NUM);
                }
                ?>
            </table>
            <br/>
            <form action='/admin/gestionarTabla.php' method='post'>
                <input type="submit" value="Nuevo" name="submit">
                <input type="submit" value="Volver" name="submit">

            </form>
        </fieldset>

        </div>

        <br/>
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
    </div> 
</body>
</html>