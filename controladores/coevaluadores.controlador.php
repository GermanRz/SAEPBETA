<?php

class ControladorCoevaluadores {

    static public function ctrMostrarCoevaluadores() {
        $respuesta = ModeloCoevaluadores::mdlMostrarCoevaluadores();
        return $respuesta;
    }

}
