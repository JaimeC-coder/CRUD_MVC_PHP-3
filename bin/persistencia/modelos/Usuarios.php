<?php
class Usuarios extends ModeloGenerico
{
    protected $id, $nombres, $apellidos, $edad, $correo, $telefono, $fecha_registro;
    public function __construct($propiedaes = null)
    {
        parent::__construct("usuario", Usuarios::class, $propiedaes);
    }
    function getId()
    {
        return $this->id;
    }
    function getNombres()
    {
        return $this->nombres;
    }
    function getApellidos()
    {
        return $this->apellidos;
    }
    function getEdad()
    {
        return $this->edad;
    }
    function getCorreo()
    {
        return $this->correo;
    }
    function getTelefono()
    {
        return $this->telefono;
    }
    function getFecha_registro()
    {
        return $this->fecha_registro;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }
    function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    function setEdad($edad)
    {
        $this->edad = $edad;
    }
    function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

}
