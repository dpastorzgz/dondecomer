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

        $db = new databaseAdmin($conexion);

        $opcion = $_POST['submit']??null;
        $campos = $_SESSION['campos'];
        $tabla = $_SESSION['tabla'];
        
        switch ($_POST['enviar']) {
            case 'Guardar':
                $parametros = [];
                $parametrosWhere = [];
                $sentencia = "UPDATE " . $tabla . " SET ";
                $param = '';
                $param2 = '';
                $num = 0;
                $contadorParamSet = 0;
                $contadorParamWhere = 0;
        
                if($_POST) {
                    foreach ($_POST as $clave=>$valor) {
                        if ($clave != 'enviar') {
                            $var = explode('clv-',$clave);
                            if ($var[0] != '') {
                                if ($contadorParamSet != 0) {
                                    $param = $param  . " , ";
                                }
                                $clv = explode('_',$var[0]);
                                $param = $param  . " " . $clv[0] . "=?";
        
                                $parametros[] = $valor;
                                $contadorParamSet++;
                            } else {
                                if ($contadorParamWhere != 0) {
                                    $param2 = $param2  . " AND ";
                                }
        
                                $clv = explode('_',$var[1]);
                                $val = trim($valor);
                                $param2 = $param2  . " " . $clv[0] . "=?";
                                $parametrosWhere[] = $val;
                                $contadorParamWhere++;
                            }
                        }
                    }
                }
        
                $sentencia = $sentencia . $param . " WHERE " . $param2;
                echo "Sentencia ".$sentencia."</br>";
                var_dump($parametros); echo"</br>";
                var_dump($parametrosWhere); echo "</br>";
                $db->ejecutarSentencia($sentencia,$parametros,$parametrosWhere);
            
                header("Location:/admin/gestionarTabla.php");
                exit();
        
            case 'Cancelar':
                header("Location:/admin/estionarTabla.php");
                exit();
        
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
                
                <form action="/admin/admin.php" method="POST">
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

        <div class=row">
            <fieldset class="fieldset">
                <legend>Editanto Registro de la tabla <?php echo $tabla ?></legend>
                <form action="/admin/editar.php" method="post">
                    <?php
                    if($_GET)
                    {
                    $num = 0;
                    foreach ($_GET as $clave=>$valor)
                    { ?>

                        <?= $clave ?> <input type="text" value="<?= $valor ?> " name="<?= $clave ?> " id=""><br />


                        <input type="hidden" value="<?= $valor ?> " name="<?= "clv-" . $clave ?> " id=""><br />
                    <?php $num++;}
                    }?>

                    <input type="submit" value="Guardar" name='enviar'>
                    <input type="submit" value="Cancelar" name='enviar'>
                    
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
</body>
</html>