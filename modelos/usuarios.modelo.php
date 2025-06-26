<?php

require_once "conexion.php";

class ModeloUsuarios {
static public function mdlMostrarUsuarios($valor = null) {
    if ($valor != null) {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u
            JOIN rol r ON u.ID_rol = r.ID_rol
            WHERE u.ID_usuarios = :id
        ");
        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u
            JOIN rol r ON u.ID_rol = r.ID_rol
            ORDER BY u.ID_usuarios ASC
        ");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $stmt->closeCursor();
    $stmt = null;
    return $resultado;
}



    static public function mdlIngresarUsuario($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_dc, numero, nombres, apellidos, email, email_insti, direccion, contacto1, contacto2, clave, estado, ID_rol) 
                                               VALUES (:tipo_dc, :numero, :nombres, :apellidos, :email, :email_insti, :direccion, :contacto1, :contacto2, :clave, :estado, :ID_rol)");

        $stmt->bindParam(":tipo_dc", $datos["tipo_dc"], PDO::PARAM_STR);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":email_insti", $datos["email_insti"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto1", $datos["contacto1"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto2", $datos["contacto2"], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":ID_rol", $datos["ID_rol"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlEditarUsuario($datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET tipo_dc = :tipo_dc, numero = :numero, nombres = :nombres, apellidos = :apellidos, email = :email, 
                                               email_insti = :email_insti, direccion = :direccion, contacto1 = :contacto1, contacto2 = :contacto2, ID_rol = :ID_rol 
                                               WHERE ID_usuarios = :ID_usuarios");

        $stmt->bindParam(":tipo_dc", $datos["tipo_dc"], PDO::PARAM_STR);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":email_insti", $datos["email_insti"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto1", $datos["contacto1"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto2", $datos["contacto2"], PDO::PARAM_STR);
        $stmt->bindParam(":ID_rol", $datos["ID_rol"], PDO::PARAM_INT);
        $stmt->bindParam(":ID_usuarios", $datos["ID_usuarios"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
    
    static public function mdlCambiarEstadoUsuario($id, $estado) {
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET estado = :estado WHERE ID_usuarios = :id");

        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlMostrarUsuarioPorCorreo($email) {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u
            JOIN rol r ON u.ID_rol = r.ID_rol
            WHERE u.email = :email
            LIMIT 1
        ");
    
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve array o false
    }
    
    
}
