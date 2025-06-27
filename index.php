<?php
require_once "controladores/plantilla.controlador.php";
require_once "controladores/auxiliares.controlador.php";
require_once "controladores/programas.controlador.php";
require_once "controladores/modalidades.controlador.php";
require_once "controladores/fichas.controlador.php";
require_once "controladores/sedes.controlador.php";
require_once "controladores/aprendices.controlador.php";
require_once "controladores/evaluadores.controlador.php";
require_once "controladores/coevaluadores.controlador.php";
require_once "controladores/usuarios.controlador.php";




require_once "modelos/fichas.modelo.php";
require_once "modelos/auxiliares.modelo.php";
require_once "modelos/programas.modelo.php";
require_once "modelos/modalidades.modelo.php";
require_once "modelos/sedes.modelo.php";
require_once "modelos/aprendices.modelo.php";
require_once "modelos/evaluadores.modelo.php";
require_once "modelos/coevaluadores.modelo.php";
require_once "modelos/usuarios.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();