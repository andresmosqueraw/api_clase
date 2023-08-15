<?php
require_once 'config.php';

class Connection {
    public static function connect() {
        $conn = false;
        try {
            $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
            $conn = new PDO($data, DB_USER, DB_PASSWORD);
            return $conn;  // Retorna la conexión
        }
        catch (PDOException $e) {
            $mensaje = array(
                "COD" => "000",
                "MENSAJE" => ("Error de conexión: ".$e->getMessage())
            );
            echo ($e->getMessage());
            return false; // Asegúrate de retornar false en caso de error
        }        
    }    
}

?>