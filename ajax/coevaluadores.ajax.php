<?php

    require_once "../controladores/coevaluadores.controlador.php";
    require_once "../modelos/coevaluadores.modelo.php";

    class AjaxCoevaluadores{

        public $id_coevaluador;
        public $estado_coevaluador;

        public function ajaxTraerCoevaluador(){
            $valor = $this->id_coevaluador;
            // ✅ CORREGIDO: Usar el método correcto que acepta parámetros
            $respuesta = ControladorCoevaluadores::ctrMostrarCoevaluador($valor);
            echo json_encode($respuesta);
        }

        public function ajaxCambiarEstado(){
            $valorId = $this->id_coevaluador;
            $estado = $this->estado_coevaluador;

            $respuesta = ControladorCoevaluadores::ctrCambiarEstadoCoevaluadar($valorId, $estado);

            var_dump($respuesta);
            echo json_encode($respuesta);
        }

    }

    if (isset($_POST["id_usuarios"])){
        $coevaluador = new AjaxCoevaluadores();
        $coevaluador->id_coevaluador = $_POST["id_usuarios"];
        $coevaluador->ajaxTraerCoevaluador();       
    }

    if (isset($_POST["id_cambiarEstado"]) && isset($_POST["estadoCoevaluador"])){ // ✅ CORREGIDO: usar isset() correctamente
        $activarcoevaluador = new AjaxCoevaluadores();
        $activarcoevaluador->id_coevaluador=$_POST["id_cambiarEstado"];
        $activarcoevaluador->estado_coevaluador=$_POST["estadoCoevaluador"];
        $activarcoevaluador->ajaxCambiarEstado();
    }