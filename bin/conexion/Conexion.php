<?php

class Conexion
{
    private $conexion;
    private $configuracion = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "proyecto1",
        "port" => "3306",
        "username" => "root",
        "pass" => "root",
        "charset" => "utf8mb4"
    ];
    public function __construct()
    {
    }
    public function conectar()
    {
        try {
            $CONTROLADOR = $this->configuracion["driver"];
            $SERVIDOR = $this->configuracion["host"];
            $BASE_DE_DATOS = $this->configuracion["database"];
            $PUERTO = $this->configuracion["port"];
            $USUARIO = $this->configuracion["username"];
            $CLAVE = $this->configuracion["pass"];
            $CODIFICACION = $this->configuracion["charset"];

            $url = "{$CONTROLADOR}:host={$SERVIDOR}:{$PUERTO};" . "
            dbname={$BASE_DE_DATOS};charset={$CODIFICACION}";
            $this->conexion = new PDO($url, $USUARIO, $CLAVE);
            //echo "Conexion exitosass";
            return $this->conexion;
        } catch (PDOException $e) {
            echo "no se pudo conetar a la base de datos";
            echo "Error: " . $e->getTraceAsString();
        }
    }
}
