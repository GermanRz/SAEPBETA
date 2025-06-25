<?php

require_once "../modelos/seguimiento.modelo.php";
require_once "../controladores/seguimiento.controlador.php";

// Validar que lleguen los datos por POST
if (isset($_POST["id"]) && isset($_POST["observacion"])) {

    $id = $_POST["id"];
    $observacion = $_POST["observacion"];

    $respuesta = ControladorSeguimiento::ctrEditarObservacion($id, $observacion);
    echo $respuesta;
}