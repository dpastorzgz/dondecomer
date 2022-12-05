<!DOCTYPE html>
<html lang="en">

<head>
    <title>DondeComer</title>
    <meta charset="utf-8">
    <meta name="description" content="Donde comer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="css/dondeComerLogo.jpg"> 

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
</head>

<body>
    <?php 
        $url = $_SERVER[HTTP_HOST];
        
        if ($_SERVER[REQUEST_URI] == '/?admin') {
          header('Location: /admin/admin.php');
        }
        
        spl_autoload_register(function($clase) {
          require_once "./classes/$clase.php";
        });

        $db = new database();
        $conn = $db->open();
        $datosCiudades = $db->consultarCiudades($conn);
        $codigoCiudad = $db->codigoCiudad($conn,$url);
        $barrios = $db->consultarBarrios($conn,$codigoCiudad);
        $codigoBarrio = $_GET['Barrio'];
        $restaurantes = $db->consultarRestaurantes($conn,$codigoCiudad,$codigoBarrio);

        $conn = $db->close($conn);

    ?>    
    <div class="container-fluid">
        <div class="navbar navbar-default navbar- navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" aria-expanded="ciudades" aria-expanded="false" data-target="#ciudades">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Ciudades</a>
                </div>
                <div class="navbar-collapse collapse" id="ciudades">
                    <ul class="nav navbar-nav">
                        <?php
                            while ($fila = mysqli_fetch_array($datosCiudades)){
                        ?>                     
                        <li class="active">
                            <a href="<?= $fila['url'] ?>"><?= $fila['nombreciudad'] ?></a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="caja-art col-sm-2 col-md-2 col-lg-2 hidden-xs text-center text-uppercase">
            <img class="iconocomer" src="/css/dondeComerLogo.jpg"/>
            </div>
            <div class="caja-art col-sm-10 col-md-10 col-lg-10 col-xs-10 text-center text-uppercase">
            <img class="iconotitulo" src="/css/dondeComerTitulo.png"/>    
            </div>
        </div>        

        <div class="navbar navbar-default navbar- navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" aria-expanded="barrios" aria-expanded="false" data-target="#barrios">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Barrios</a>
                </div>
                <div class="navbar-collapse collapse" id="barrios">
                    <ul class="nav navbar-nav">
                        <?php
                            while ($fila = mysqli_fetch_array($barrios)){
                              $urlCategoria = 'http://' . $url . '/?Barrio=' . $fila['codigoBarrio'];
                        ?>                     
                        <li class="active">
                            <a href="<?= $urlCategoria ?>"><?= $fila['nombreBarrio'] ?></a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php
            while ($fila = mysqli_fetch_array($restaurantes)){
        ?>        
        <div class="row">  
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-center text-uppercase">
                <img class="iconorest" src="<?= $fila['urlLogo'] ?>"/>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 text-center text-uppercase">
            <div>
                <div class="texto">
                  <strong><?= $fila['nombreRestaurante'] ?></strong>
                </div>                
                <div class="texto">
                  <p><?= $fila['descripcion'] ?></p>
                  <?php
                    if ($fila['urlOficial'] != ' ' & $fila['urlOficial'] != null) { 
                  ?>
                      <a href="<?= $fila['urlOficial'] ?>" target="_blank">Visita su carta</a>
                  <?php
                    }
                  ?>
                </div>
                <div class="texto">
                <?php
                  if ($fila['urlInstagram'] != ' ' & $fila['urlInstagram'] != null) { 
                ?>
                    <a href="<?= $fila['urlInstagram'] ?>" target="_blank"><img class="iconoface" src="css/instagram.png"/></a>
                <?php
                  }
                ?>
                <?php
                  if ($fila['urlFacebook'] != ' ' & $fila['urlFacebook'] != null) { 
                ?>
                    <a href="<?= $fila['urlFacebook'] ?>" target="_blank"><img class="iconoface" src="css/facebook.png"/></a>
                <?php
                  }
                ?>                
                <?php
                  if ($fila['urlUber'] != ' ' & $fila['urlUber'] != null) { 
                ?>
                    <a href="<?= $fila['urlUber'] ?>" target="_blank"><img class="iconoface" src="css/ubereats.png"/></a>
                <?php
                  }
                ?>                  
                <?php
                  if ($fila['urlGlovo'] != ' ' & $fila['urlGlovo'] != null) { 
                ?>
                    <a href="<?= $fila['urlGlovo'] ?>" target="_blank"><img class="iconoface" src="css/glovo.png"/></a>
                <?php
                  }
                ?>   
                </div>
                <div class="mapa">
                  <iframe class="mapaIframe" src=<?= $fila['urlMaps'] ?>></iframe>
                </div>
              </div>
            </div>    
        </div> 
        <hr/>  
        <?php
            }
        ?>             
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>
