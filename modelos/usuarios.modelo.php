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

    // Nuevo método para obtener usuario por ID para EDITAR PERFIL
    static public function mdlMostrarUsuarioPorId($tabla, $id){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE ID_usuarios = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;
    }

    // Nuevo método para actualizar usuario
    static public function mdlEditarUsuario($tabla, $datos){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("UPDATE $tabla SET 
            nombres = :nombres,
            apellidos = :apellidos,
            tipo_dc = :tipo_dc,
            numero = :numero,
            email = :email,
            email_insti = :email_insti,
            direccion = :direccion,
            contacto1 = :contacto1,
            estado = :estado,
            ID_rol = :id_rol
            WHERE ID_usuarios = :id");

        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_dc", $datos["tipo_dc"], PDO::PARAM_STR);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":email_insti", $datos["email_insti"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto1", $datos["contacto1"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }


}//FIN CLASE ModeloUsuarios