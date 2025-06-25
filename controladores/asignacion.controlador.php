<?php

class ControladorAsignacion {

    static public function ctrMostrarAprendices() {
        return ModeloAsignacion::mdlMostrarAprendices();
    }

    static public function ctrMostrarEvaluadores() {
        return ModeloAsignacion::mdlMostrarEvaluadores();
    }

    static public function ctrAsignarEvaluador($idAprendiz, $idEvaluador) {
        return ModeloAsignacion::mdlAsignarEvaluador($idAprendiz, $idEvaluador);
    }

    static public function ctrEliminarEvaluador($idAprendiz) {
        return ModeloAsignacion::mdlEliminarEvaluador($idAprendiz);
    }

}

