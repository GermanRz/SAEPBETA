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
    /*=============================================
    OBTENER PROGRESO DEL APRENDIZ
    =============================================*/
    static public function mdlObtenerProgresoAprendiz($idAprendiz) {
        try {
            // Consulta para obtener el progreso basado en la ficha del aprendiz
            $stmt = Conexion::conectar()->prepare(
                "SELECT 
                    f.fecha_inicio,
                    f.fecha_final AS fecha_fin,
                    ROUND(
                        (DATEDIFF(CURDATE(), f.fecha_inicio) / 
                        NULLIF(DATEDIFF(f.fecha_final, f.fecha_inicio), 0) * 100), 0
                    ) AS porcentaje_completado,
                    p.nombre_programa,
                    s.nombre_sede,
                    m.modalidad AS modalidad_formacion
                FROM aprendices a
                JOIN fichas f ON a.ID_Fichas = f.ID_Fichas
                JOIN programas p ON f.ID_programas = p.ID_programas
                JOIN sede s ON f.ID_sede = s.ID_sede
                JOIN modalidad m ON a.ID_modalidad = m.ID_modalidad
                WHERE a.ID_usuarios = :id_aprendiz
                AND a.estado = 'En curso'"
            );
            
            $stmt->bindParam(":id_aprendiz", $idAprendiz, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Validar y ajustar porcentaje
            if($resultado) {
                $porcentaje = $resultado['porcentaje_completado'];
                $resultado['porcentaje_completado'] = min(max($porcentaje, 0), 100);
                return $resultado;
            }
            
            // Valores por defecto si no hay ficha asignada
            return [
                'porcentaje_completado' => 0,
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                'nombre_programa' => 'Programa no asignado',
                'nombre_sede' => 'Sede no asignada',
                'modalidad_formacion' => 'Modalidad no asignada'
            ];
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerProgresoAprendiz: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    OBTENER NOVEDADES DEL APRENDIZ
    =============================================*/
    static public function mdlObtenerNovedadesAprendiz($idAprendiz) {
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT n.novedad, n.fecha 
                FROM novedades n
                JOIN aprendices a ON n.ID_aprendiz = a.ID_numeroAprendices
                WHERE a.ID_usuarios = :id_aprendiz
                ORDER BY n.fecha DESC
                LIMIT 5"
            );
            
            $stmt->bindParam(":id_aprendiz", $idAprendiz, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerNovedadesAprendiz: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }
}//FIN CLASE ModeloUsuarios
