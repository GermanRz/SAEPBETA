<?php

require_once "../modelos/verUsuarios.modelo.php";

if (isset($_POST["id_cambiarEstadoUsuario"])) {

    $id = $_POST["id_cambiarEstadoUsuario"];
    $nuevoEstado = $_POST["estadoUsuario"];

    $respuesta = ModeloVerUsuarios::mdlActualizarEstadoUsuario($id, $nuevoEstado);
    echo $respuesta;
}
