<?php

require_once "modelos/auxiliares.modelo.php";

class ControladorAuxiliares {

    static public function ctrMostrarAuxiliares() {
        $respuesta = ModeloAuxiliares::mdlMostrarAuxiliares();
        return $respuesta;
    }
}
