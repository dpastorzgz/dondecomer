<?php 
class database {

    private $servername = "localhost";
    private $database = "dondecomer";
    private $username = "david";
    private $password = "qwerty";

    public function __construct () {

    }

    public function open () {
        // Create connection
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        echo "<br>";

        return $conn;
    }

    public function close ($conn) {
        // Close connection
        mysqli_close($conn);
    }

    public function consultarCiudades ($conn) {
        $result = $conn->query("SELECT url FROM ciudades");
        printf("Select returned %d rows.\n", $result->num_rows);
        echo "<br>";

        $result = mysqli_query($conn, "SELECT url,nombreciudad FROM ciudades");
        return $result;
    }    

    public function mostrarDatos ($resultados) {

        while ($fila = mysqli_fetch_array($resultados)){
             echo "- URL: ".$fila['url'];
             echo "- NOMBRE: ".$fila['nombreciudad']."<br/> ";
        }
    }
}

?>