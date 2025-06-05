<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function mdlMostrarUsuarios($tabla, $item, $valor){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE email = :email ");
        $stmt->bindParam(":email", $valor, PDO::PARAM_STR);

        $stmt-> execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;



    }


}//FIN CLASE ModeloUsuarios