<html lang="es">
    <head>
        <title>DondeComerZGZ</title>
        <meta charset="utf-8">
        <meta name="description" content="Donde comer en Zaragoza">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="css/dondeComerLogo.jpg">
        <script src="js/bootstrap.js"></script>
    </head>
    <body>
        <?php 
        $link = $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
        $escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
        echo $escaped_link; 

        echo "<br>";

        // $servername = "localhost";
        // $database = "dondecomer";
        // $username = "david";
        // $password = "qwerty";

        // // Create connection
        // $conn = mysqli_connect($servername, $username, $password, $database);
        // // Check connection
        // if (!$conn) {
        //     die("Connection failed: " . mysqli_connect_error());
        // }
        // echo "Connected successfully";
        // echo "<br>";

        // $result = $conn->query("SELECT url FROM ciudades");
        // printf("Select returned %d rows.\n", $result->num_rows);
        // echo "<br>";

        // $result = mysqli_query($conn, "SELECT url,nombreciudad FROM ciudades");

        // while ($fila = mysqli_fetch_array($result)){
        //   mostrarDatos($fila);
        // }

        // mysqli_close($conn);

        // function mostrarDatos ($resultados) {

        //   if ($resultados !=NULL) {
        //     echo "- URL: ".$resultados['url'];
        //     echo "- NOMBRE: ".$resultados['nombreciudad']."<br/> ";
        //   }
        //   else {
        //     echo "<br/>No hay más datos!!! <br/>";
        //   }
        // }

        spl_autoload_register(function($clase) {
          require_once "classes/$clase.php";
        });

        $db = new database();
        $conn = $db->open();

        $datosCiudades = $db->consultarCiudades($conn);

        $db->mostrarDatos($datosCiudades);

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
                        <li class="nav-item">
                            <a class="nav-link colorLink" aria-current="page" href="http://www.dondecomerZGZ.com">Zaragoza</a>
                          </li>                        
                      <li class="nav-item">
                        <a class="nav-link colorLink" aria-current="page" href="http://www.dondecomerMAD.com">Madrid</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link colorLink" aria-current="page" href="http://www.dondecomerBCN.com">Barcelona</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link colorLink" aria-current="page" href="http://www.dondecomerVAL.com">Valencia</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link colorLink" aria-current="page" href="http://www.dondecomerMUR.com">Murcia</a>
                      </li>                      
                    </ul>
                  </div>
                </div>
            </nav>
            </div>
        </div>        
        <div class="contenedor">
            <div class="cabecera">
                <div class="logo"><img class="iconocomer" src="css/dondeComerLogo.jpg"/></div>
                <div class="titulo"><img class="iconotitulo" src="css/dondeComerTitulo.png"/></div>
            </div>
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">                   
                    <div class="container-fluid">                    
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>                         
                      <a class="navbar-brand posBarra" href="#">Categorías</a>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="nav justify-content-center me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a class="nav-link colorLink" aria-current="page" href="#">Carne</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link colorLink" aria-current="page" href="#">Sushi</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link colorLink" aria-current="page" href="#">Croquetas</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="restarurantes">
            <div class="restarurante">
                <div><img class="iconorest" src="css/croquetArte.png"/></div> 
                <div>
                    <div class="texto">
                        <p>CroquetArte es un establecimiento que te ofrece gran variedad de sabores y formatos de croquetas absolutamente exquisitas. Disfruta de toda nuestra variedad y constantes novedades de sabores en nuestro local, para llevar e incluso para cocinarlas en tu casa. Comparte nuestra pasión por las croquetas y deleitate con nuestra elaboración casera en nuestro propio obrador.

                            CroquetArte es tienda y es degustación
                            
                            CroquetArte es tienda porque se exponen las croquetas frescas en las vitrinas, y se dispensan para llevar a casa en cajas de 6 o de 12 unidades para el tamaño estándar y de 12 o 24 para las croquetas de cocktail. La venta es a peso. Se pueden freír y que el cliente no tenga más que comérselas, bien en su casa o bien en un envase tipo cucurucho para llevar y comer por la calle.
                            
                            Croquet Arte es degustación porque dispone de una zona independiente, pero completamente integrada en el espacio y en el funcionamiento de la tienda, donde las croquetas se pueden consumir en el propio establecimiento de forma distendida y amena en un tamaño extra grande (el croquetón), acompañado y maridado con las mejores cervezas de la tierra y vinos de todas las D.O aragonesas, en un ambiente acogedor y casero y con las preciosas vistas del Palacio de los Condes de Morata (la Audiencia) justo enfrente.
                        </p>
                        <a href="https://www.croquetarte.es/" target="_blank">Visita su carta</a>
                    </div>
                    <div class="texto">
                        <a href="https://es-es.facebook.com/croquetartezaragoza/" target="_blank"><img class="iconoface" src="css/facebook.png"/></a>
                        <a class="ico" href="https://www.instagram.com/croquet_arte/?hl=es" target="_blank"><img class="iconoinsta" src="css/instagram.png"/></a>
                    </div>
                    <div class="texto">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11924.368651530758!2d-0.8836752!3d41.6537507!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2b13bd0cf1aaf17a!2sCroquet%20Arte!5e0!3m2!1ses!2ses!4v1661416520524!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="restarurante">
                <div><img class="iconorest" src="css/DoñaCasta.png"/></div> 
                <div>
                    <div class="texto">
                        <p>Taberna Doña Casta está situada en la zona del Tubo en pleno centro de la ciudad de Zaragoza

                            Estamos especializados en croquetas caseras y huevos rotos.
                            
                            Disfruta de nuestras especialidades en barra, en nuestra terraza o en nuestro salón comedor.
                        </p>
                        <a href="https://tabernadonacasta.es/?page_id=7" target="_blank">Visita su carta</a>
                    </div>
                    <div class="texto">
                        <a href="https://es-es.facebook.com/tabernadonacasta/" target="_blank"><img class="iconoface" src="css/facebook.png"/></a>
                        <a class="ico" href="https://www.instagram.com/tabernadonacasta/?hl=es" target="_blank"><img class="iconoinsta" src="css/instagram.png"/></a>
                    </div>
                    <div class="texto">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11924.413026265085!2d-0.8801388!3d41.653511!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdb67e4d358e59255!2sTaberna%20Do%C3%B1a%20Casta!5e0!3m2!1ses!2ses!4v1661416941948!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>      
            <hr/>      
        </div>
    </body>
    <footer></footer>
</html>