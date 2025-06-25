<?php

    class ControladorVerUsuarios{

        /*=============================================
        MOSTRAR USUARIOS
        =============================================*/

        static public function ctrMostrarUsuariosPorTipo($tipo) {
        return ModeloVerUsuarios::mdlMostrarUsuariosPorTipo($tipo);
    }
}//   fin metodo ctrMostrarUsuarios

