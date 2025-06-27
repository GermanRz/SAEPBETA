<?php

require_once "conexion.php";

class ModeloCoevaluadores {

    static public function mdlMostrarCoevaluadores() {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u 
            INNER JOIN rol r ON u.ID_rol = r.ID_rol 
            WHERE u.ID_rol = 3
        ");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    // ✅ AGREGADO: Método para obtener un coevaluador específico
    static public function mdlMostrarCoevaluador($valor) {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u 
            INNER JOIN rol r ON u.ID_rol = r.ID_rol 
            WHERE u.ID_usuarios = :id_usuario AND u.ID_rol = 3
        ");
        $stmt->bindParam(":id_usuario", $valor, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    // Insertar nueva ficha
    static public function mdlIngresarCoevaluador($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla 
                (tipo_dc, numero, nombres, apellidos, email, email_insti, direccion, contacto1, contacto2, clave, estado, ID_rol)
                VALUES 
                (:tipo_dc, :numero, :nombres, :apellidos, :email, :email_insti, :direccion, :contacto1, :contacto2, :clave, 'Activo', 3 )");
    
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
    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
    
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            if ($stmt) {
                $stmt->closeCursor();
                $stmt = null;
            }
        }
    }
    
    // ✅ CORREGIDO: Editar Coevaluador con contraseña opcional
static public function mdlEditarCoevaluador($datos) {
    try {
        // Si la contraseña está vacía, no la actualizamos
        if (empty($datos["clave"])) {
            $stmt = Conexion::conectar()->prepare("UPDATE usuarios 
                                                   SET tipo_dc = :tipo_dc,
                                                       numero = :numero,
                                                       nombres = :nombres,
                                                       apellidos = :apellidos,
                                                       email = :email,
                                                       email_insti = :email_insti,
                                                       direccion = :direccion,
                                                       contacto1 = :contacto1,
                                                       contacto2 = :contacto2
                                                   WHERE ID_usuarios = :id_usuarios");
        } else {
            $stmt = Conexion::conectar()->prepare("UPDATE usuarios 
                                                   SET tipo_dc = :tipo_dc,
                                                       numero = :numero,
                                                       nombres = :nombres,
                                                       apellidos = :apellidos,
                                                       email = :email,
                                                       email_insti = :email_insti,
                                                       direccion = :direccion,
                                                       contacto1 = :contacto1,
                                                       contacto2 = :contacto2,
                                                       clave = :clave
                                                   WHERE ID_usuarios = :id_usuarios");
        }

        $stmt->bindParam(":id_usuarios", $datos["ID_usuarios"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_dc", $datos["tipo_dc"], PDO::PARAM_STR);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":email_insti", $datos["email_insti"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto1", $datos["contacto1"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto2", $datos["contacto2"], PDO::PARAM_STR);
        
        // Solo bind de contraseña si no está vacía
        if (!empty($datos["clave"])) {
            $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    } finally {
        if ($stmt) {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
}

    // Cambiar estado (Activo/Inactivo)
    static public function mdlCambiarEstadoCoevaludar($valor, $estado) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET estado = :estado WHERE ID_usuarios = :id_usuarios");
        
            $stmt->bindParam(":id_usuarios", $valor, PDO::PARAM_INT);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            if ($stmt) {
                $stmt->closeCursor();
                $stmt = null;
            }
        }
    }
}