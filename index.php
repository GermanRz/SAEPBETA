<?php
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/programas.controlador.php";
require_once "controladores/seguimiento.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/programas.modelo.php";
require_once "modelos/seguimiento.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();