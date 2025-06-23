<?php

    require_once "../controladores/programas.controlador.php";
    require_once "../modelos/programas.modelo.php";

    class AjaxProgramas{

        public $id_programa;
        public $estado_programa;

        public function ajaxTraerPrograma(){

            $valor = $this->id_programa;
            $respuesta = ControladorProgramas::ctrMostrarProgramas($valor);
            echo json_encode($respuesta);

        }//Fin ajaxTraerprograma

        public function ajaxCambiarEstado(){
            $valorId = $this->id_programa;
            $estado = $this->estado_programa;

            $respuesta = ControladorProgramas::ctrCambiarEstadoPrograma($valorId, $estado);

            echo json_encode($respuesta);


        }

    }//fin clase Ajaxprogramas

    if (isset($_POST["id_programa"])){
        $programa = new AjaxProgramas();
        $programa->id_programa = $_POST["id_programa"];
        $programa->ajaxTraerPrograma();       
    }

    if (isset($_POST["id_cambiarEstado"]) && ($_POST["estadoPrograma"])){
        $activarPrograma = new AjaxProgramas();
        $activarPrograma->id_programa=$_POST["id_cambiarEstado"];
        $activarPrograma->estado_programa=$_POST["estadoPrograma"];
        $activarPrograma->ajaxCambiarEstado();
    }