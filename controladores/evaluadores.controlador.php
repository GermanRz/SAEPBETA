<?php

class ControladorEvaluadores {

    static public function ctrMostrarEvaluadores() {
        $respuesta = ModeloEvaluadores::mdlMostrarEvaluadores();
        return $respuesta;
    }

}
