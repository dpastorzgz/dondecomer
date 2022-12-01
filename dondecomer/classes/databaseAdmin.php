<?php

class databaseAdmin {
    private $servername = "mysql:host=localhost";
    private $host = 'localhost';
    private $databaseComer = "dondecomer";
    private $username = "david";
    private $password = "qwerty";  

    public function __construct($datosConexion=null,$tabla=null) {
        
        $host = 'mysql:host=' . $this->host;        
        $host = $host . ";dbname=" . $this->databaseComer;

        try {
            if ($host != '' and $this->username != '' and $this->password != '') {
            $this->con = new PDO($host,$this->username,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->msj = NULL;
            } else
            $this->msj = 'Faltan parámetros para realizar la conexión';
        } catch (PDOException $e) {
            $this->msj = 'Falló la conexión: ' . $e->getMessage();
        }
    }

    public function get_error_message() {
        return $this->msj;
    }

    public function show_Databases(){
        $resultado = [];

        if ($this->msj == NULL) {
            $dbs = $this->con->query('SHOW DATABASES');
            while( ( $db = $dbs->fetchColumn( 0 ) ) !== false )
            {
                if ($db==$this->databaseComer) {
                    $resultado[] = $db; 
                }
            }
        }
        return $resultado;
    }

    public function show_Tables() {
        $resultado = array();
        try {
            $sql = "SHOW TABLES";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $tables = $statement->fetchAll(PDO::FETCH_NUM);
            foreach($tables as $table){
                $resultado[] = $table[0];
            }
        }
        catch (PDOException $e) {
            $this->msj = $e->getMessage();
        }
        return $resultado;
    }

    public function campos($tabla):array {
        $resultado = [];
        try {
            $sentencia = 'SELECT * FROM ' . $tabla;
            $select = $this->con->query($sentencia);
            $total_column = $select->columnCount();

            for ($counter = 0; $counter < $total_column; $counter ++) {
                $meta = $select->getColumnMeta($counter);
                $resultado[] = $meta['name'];
            }
        } catch (PDOException $e) {
            $this->msj = $e->getMessage();
        }
        return $resultado;
    }

    public function seleccionar($sentencia):object {
        try {
            $rdto = $this->con->query($sentencia);
            return $rdto;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "$error";
        }
    }    

    public function ejecutarSentencia($sentencia,$parametros,$parametrosWhere=null) {
        $stmt = $this->con->prepare($sentencia);
        $num = 0;
        foreach ($parametros as $param) {
            $num++;
            $stmt->bindValue($num,$param);
        }
        if ($parametrosWhere != null) {
            foreach ($parametrosWhere as $paramWhere) {
                $num++;
                $stmt->bindValue($num,$paramWhere);
            }
        }
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            $this->msj = "Error borrando, tener encuenta las relaciones de integridad referencial <br />" . $ex->$this->get_error_message();
        }
    }

    public function cerrarDB() {
        $this->con = null;
    }

}
