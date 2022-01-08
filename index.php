<?php
require_once './bin/conexion/Conexion.php';
require_once './bin/persistencia/Crud.php';
require_once './bin/persistencia/modelos/ModeloGenerico.php';
require_once './bin/persistencia/modelos/Usuarios.php';


$modeloUsuario=new Usuarios();
$registro=$modeloUsuario->where("id","=",1)->get();
//$usuarios = $modeloUsuario->get();
echo "<pre>";
//var_dump((new Usuarios())->get());
var_dump($registro);
echo "</pre>";
