<?php 
class database {

    private $servername = "localhost";
    private $database = "dondecomer";
    private $username = "david";
    private $password = "qwerty";

    public function __construct () {

    }

    public function open () {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    public function close ($conn) {
        mysqli_close($conn);
    }

    public function consultarCiudades ($conn) {
        $result = mysqli_query($conn, "SELECT url,nombreciudad,codigociudad FROM ciudades");     
        return $result;
    }    

    public function codigoCiudad ($conn,$url) {
        $urlConsulta = 'http://'.$url.'/';     
        $consulta = 'SELECT codigociudad FROM ciudades WHERE url = \''.$urlConsulta.'\'';
        $result = mysqli_query($conn, $consulta);         
        $codigo= mysqli_fetch_array($result);
        return $codigo[0];
    }    

    public function consultarBarrios ($conn,$codigo) {
        $consulta = 'SELECT nombreBarrio,codigoBarrio,codigoCiudad FROM barrios WHERE codigociudad = \''.$codigo.'\'';
        $result = mysqli_query($conn, $consulta);              
        return $result;
    }      

    public function consultarRestaurantes ($conn,$codigoCiudad,$codigoBarrio) {
        $consulta = 'SELECT nombreRestaurante,codigoRestaurante,codigoCiudad,codigoBarrio,descripcion,urlLogo,urlInstagram,urlUber,urlGlovo,urlMaps,urlOficial,urlFacebook FROM restaurantes WHERE codigoCiudad = \''.$codigoCiudad.'\'';
        if ($codigoBarrio != '') {
            $consulta = 'SELECT nombreRestaurante,codigoRestaurante,codigoCiudad,codigoBarrio,descripcion,urlLogo,urlInstagram,urlUber,urlGlovo,urlMaps,urlOficial,urlFacebook FROM restaurantes WHERE codigoCiudad = \''.$codigoCiudad.'\' AND codigoBarrio = \''.$codigoBarrio.'\'';
        }
        $result = mysqli_query($conn, $consulta);             
        
        // printf("Select returned %d rows.\n", $result->num_rows);
        // echo "<br>";

        return $result;
    }      
}
?>