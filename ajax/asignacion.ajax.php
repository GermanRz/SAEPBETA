<?php

require_once "../controladores/asignacion.controlador.php";
require_once "../modelos/asignacion.modelo.php";

if (isset($_POST["asignar"])) {
    $respuesta = ControladorAsignacion::ctrAsignarEvaluador($_POST["id_aprendiz"], $_POST["id_evaluador"]);
    echo $respuesta;
}

if (isset($_POST["eliminar"])) {
    $respuesta = ControladorAsignacion::ctrEliminarEvaluador($_POST["id_aprendiz"]);
    echo $respuesta;
}
