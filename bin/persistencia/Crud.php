<?php

class Crud
{
    protected $tabla;
    protected $conexion;
    protected $wheres = "";
    protected $sql = null;

    public function __construct($tabla = null){
        $this->tabla = $tabla;
        $this->conexion = (new Conexion())->conectar();
        $this->tabla = $tabla;
    }
    public function get(){
        try {
            $this->sql = "SELECT * FROM {$this->tabla} {$this->wheres}";
            $sentencia = $this->conexion->prepare($this->sql);
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_OBJ);;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function insert($obj){
        try {
            /**
             * $obj = [$campos=>$valores]
             * $campos = "nombre,apellido,edad"
             * $valores = "juan,perez,23"
             * lo que haces separar los campos y los valores 
             * en la consulta sql se va a mostrar algo como esto :
             * INSERT INTO usuario (nombre , apellido , edad) VALUES (:nombre , :apellido , :edad)
             */
            $campos =implode(" , ", array_keys(($obj)));
            $valores = ":" . implode(", :", array_keys(($obj)));
            $this->sql = "INSERT INTO {$this->tabla} ({$campos}) VALUES ({$valores})";
            $this->ejecutar($obj);
            $id= $this->conexion->lastInsertId();
            return $id;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function update($obj){
        try {
            $campos = "";
            foreach ($obj as $key => $value) {
                $campos .= "{$key}= :$key,";
            }
            $campos = rtrim($campos, ",");//elimina la coma de la ultima posicion

            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
            $filas=$this->ejecutar($obj);
            return $filas;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function delete(){
        try {
            $this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";
            $filas=$this->ejecutar();
            return $filas;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function where($campo, $operador, $valor){
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " AND " : " WHERE ";
        $this->wheres .= "`$campo` $operador ".((is_string($valor)) ? "\"$valor \"" : $valor)." ";

        return $this;
    }
    public function orwhere($campo, $operador, $valor){
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " OR " : " WHERE ";
        $this->wheres .= "`$campo` $operador".((is_string($valor)) ? "\"$valor \"" : $valor)." ";

        return $this;
    }
    private function ejecutar($obj=null){
        $sentencia = $this->conexion->prepare($this->sql);
        if($obj!=null){
            foreach($obj as $key=>$value){
                IF(empty($value)){
                    $value=null;
                }
                $sentencia->bindValue(":{$key}",$value);
            }
        }
        $sentencia->execute();
        $this->reinciar();
        return $sentencia->rowCount();


    }
    private function reinciar(){
        $this->wheres="";
        $this->sql=null;
    }

}
