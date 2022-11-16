<html lang="es">
    <head>
        <title>DondeComerZGZ</title>
        <meta charset="utf-8">
        <meta name="description" content="Donde comer en Zaragoza">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="css/dondeComerLogo.jpg"> 
        <script src="js/bootstrap.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php 
        $url = $_SERVER[HTTP_HOST];
        
        if ($_SERVER[REQUEST_URI] == '/?admin') {
          header('Location: /admin.php');
        }
        
        spl_autoload_register(function($clase) {
          require_once "classes/$clase.php";
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
        <div class="barraSuperior">
            <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand posBarra" href="#">Ciudades</a>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent1">

                    <ul class="nav me-auto mb-2 mb-lg-0">
                      <?php
                        while ($fila = mysqli_fetch_array($datosCiudades)){
                      ?>
                      <li class="nav-item">
                        <a class="nav-link colorLink" aria-current="page" href="<?= $fila['url'] ?>"><?= $fila['nombreciudad'] ?></a>
                      </li>
                      <?php
                        }
                      ?>
                    </ul>
                  </div>
                </div>
            </nav>
            </div>
        </div>        
        <div class="contenedor">
            <div class="cabecera">
                <div class="logo"><img class="iconocomer" src="/css/dondeComerLogo.jpg"/></div>
                <div class="titulo"><img class="iconotitulo" src="/css/dondeComerTitulo.png"/></div>
            </div>
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">                   
                    <div class="container-fluid">                    
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>                         
                      <a class="navbar-brand posBarra" href="#">Barrios</a>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="nav justify-content-center me-auto mb-2 mb-lg-0">
                          <?php
                            while ($fila = mysqli_fetch_array($barrios)){
                              $urlCategoria = 'http://' . $url . '/?Barrio=' . $fila['codigoBarrio'];
                          ?>
                            <li class="nav-item">
                              <a class="nav-link colorLink" aria-current="page" href="<?= $urlCategoria ?>"><?= $fila['nombreBarrio'] ?></a>
                            </li>
                          <?php
                            }
                          ?>
                        </ul>
                      </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="restarurantes">
          <?php
            while ($fila = mysqli_fetch_array($restaurantes)){
          ?>
          <div class="restarurante">
            
            <div><img class="iconorest" src="<?= $fila['urlLogo'] ?>"/></div> 
              <div>
                <div class="texto">
                  <p><?= $fila['descripcion'] ?></p>
                  <?php
                    if ($fila['urlOficial'] != '') { 
                  ?>
                      <a href="<?= $fila['urlOficial'] ?>" target="_blank">Visita su carta</a>
                  <?php
                    }
                  ?>
                </div>
                <div class="texto">
                <?php
                  if ($fila['urlInstagram'] != '') { 
                ?>
                    <a href="<?= $fila['urlInstagram'] ?>" target="_blank"><img class="iconoface" src="css/instagram.png"/></a>
                <?php
                  }
                ?>
                <?php
                  if ($fila['urlFacebook'] != '') { 
                ?>
                    <a href="<?= $fila['urlFacebook'] ?>" target="_blank"><img class="iconoface" src="css/facebook.png"/></a>
                <?php
                  }
                ?>                
                <?php
                  if ($fila['urlUber'] != '') { 
                ?>
                    <a href="<?= $fila['urlUber'] ?>" target="_blank"><img class="iconoface" src="css/ubereats.png"/></a>
                <?php
                  }
                ?>                  
                <?php
                  if ($fila['urlGlovo'] != '') { 
                ?>
                    <a href="<?= $fila['urlGlovo'] ?>" target="_blank"><img class="iconoface" src="css/glovo.png"/></a>
                <?php
                  }
                ?>   
                </div>
                <div class="texto">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11924.368651530758!2d-0.8836752!3d41.6537507!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2b13bd0cf1aaf17a!2sCroquet%20Arte!5e0!3m2!1ses!2ses!4v1661416520524!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
            <hr/>
        </div>
        <?php
          }
        ?>        
    </body>
    <footer></footer>
</html>