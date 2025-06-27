<?php

require_once "../controladores/empresas.controlador.php";
require_once "../modelos/administrar.modelos.php";

class AjaxAdministrarEmpresas {

    public $datos;

    public function ajaxActualizarEmpresa() {
        $tabla = "empresas";
        $respuesta = ModeloEmpresas::mdlEditarEmpresas($tabla, $this->datos);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["nit"])) {
    $ajax = new AjaxAdministrarEmpresas();

    $ajax->datos = array(
        "nit" => $_POST["nit"],
        "nombre_empresa" => $_POST["nombre"],
        "direccion" => $_POST["direccion"],
        "area" => $_POST["area"],
        "email" => $_POST["email"],
        "coevaluador" => $_POST["coevaluador"],
        "contacto" => $_POST["telefono"],
        "departamento" => $_POST["departamento"],
        "ciudad" => $_POST["ciudad"],
        "estado" => $_POST["estado"]
    );

    $ajax->ajaxActualizarEmpresa();
}
