<?php

class ModeloGenerico extends Crud
{
    private $className;
    private $excluir = ["className", "tabla", "conexion", "wheres", "sql", "excluir"];
    function __construct($tabla, $className, $propiedades = null)
    {
        parent::__construct($tabla);
        $this->className = $className;
        if (empty($propiedades)) {
            return;
        }
        foreach ($propiedades as $key => $value) {
            $this->{$key} = $value;
        }
    }
    protected function obtenerDato()
    {
        $variable = get_class_vars($this->className);
        //este me va a traer los datos de los modelos y tambien de la variable $excluir
        $atributo = [];
        $max = count($variable);
        foreach ($variable as $key => $value) {
            if (!in_array($key, $this->excluir)) {
                //esto significa que no esta en la lista de excluir y si no esta que lo agrege
                $atributo[] = $key;
            }
        }
        return $atributo;
    }
    protected function separar($obj = null)
    {
        try {
            $atributos = $this->obtenerDato();
            $objetofinal = [];
            if ($obj == null) {
                foreach ($atributos as $key => $value) {
                    if (isset($this->$value)) {
                        $objetofinal[$value] = $this->$value;
                    }
                }
                return $objetofinal;
            }
            //coregir el objeto que trae los atributos del modelo 
            foreach ($atributos as $key => $value) {
                if (isset($obj[$value])) {
                    $objetofinal[$value] = $obj[$value];
                }
            }
            return $objetofinal;
        } catch (Exception $e) {
            throw new Exception("error en : " . $this->className . "Parsear()=> " . $e->getMessage());
        }
    }
    public function fill($obj)
    {
        try {
            $atributos = $this->obtenerDato();
            foreach ($atributos as $key => $value) {
                if (isset($obj[$value])) {
                    $this->{$value} = $obj[$value];
                }
            }
        } catch (Exception $e) {
            throw new Exception("error en : " . $this->className . "fill()=> " . $e->getMessage());
        }
    }
    public function insert($obj = null)
    {
        $obj = $this->separar($obj);
        return parent::insert($obj);
    }
    public function update($obj)
    {
        $obj = $this->separar($obj);
        parent::update($obj);
    }
    public function __get($nombreAtributo){
        return $this->{$nombreAtributo};
    }

    public function __set($nombreAtributo, $valor)
    {
        $this->{$nombreAtributo} = $valor;
    }
}
