<?php

require_once "../controladores/asignacion.controlador.php";
require_once "../modelos/asignacion.modelo.php";

// Asignar evaluador
if (isset($_POST["asignar"])) {
    // Validar que los datos existan
    if (isset($_POST["id_aprendiz"]) && isset($_POST["id_evaluador"])) {
        $idAprendiz = $_POST["id_aprendiz"];
        $idEvaluador = $_POST["id_evaluador"];

        $respuesta = ControladorAsignacion::ctrAsignarEvaluador($idAprendiz, $idEvaluador);
        echo $respuesta;
    } else {
        echo "error";
    }
}

// Eliminar evaluador
if (isset($_POST["eliminar"])) {
    // Validar que el dato exista
    if (isset($_POST["id_aprendiz"])) {
        $idAprendiz = $_POST["id_aprendiz"];

        $respuesta = ControladorAsignacion::ctrEliminarEvaluador($idAprendiz);
        echo $respuesta;
    } else {
        echo "error";
    }
}

?>