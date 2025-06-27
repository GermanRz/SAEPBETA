<?php

require_once "conexion.php";

class ModeloFichas {

    // Mostrar todas las fichas o una específica
    static public function mdlMostrarFichas($valor = null) {
        if ($valor != null) {
            $stmt = Conexion::conectar()->prepare("
                SELECT f.*, p.nombre_programa, s.nombre_sede 
                FROM fichas f
                JOIN programas p ON f.ID_programas = p.ID_programas
                JOIN sede s ON f.ID_sede = s.ID_sede
                WHERE f.ID_Fichas = :id_ficha
            ");
            $stmt->bindParam(":id_ficha", $valor, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("
                SELECT f.*, p.nombre_programa, s.nombre_sede 
                FROM fichas f
                JOIN programas p ON f.ID_programas = p.ID_programas
                JOIN sede s ON f.ID_sede = s.ID_sede
                ORDER BY f.ID_Fichas ASC
            ");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    // Insertar nueva ficha
    static public function mdlIngresarFicha($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla 
                (codigo, ID_programas, ID_sede, modalidad, jornada, nivel_formacion, tipo_oferta, fecha_inicio, fecha_fin_lec, fecha_final, estado)
                VALUES 
                (:codigo, :ID_programas, :ID_sede, :modalidad, :jornada, :nivel_formacion, :tipo_oferta, :fecha_inicio, :fecha_fin_lec, :fecha_final, 'Activo')");
    
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":ID_programas", $datos["ID_programas"], PDO::PARAM_INT);
            $stmt->bindParam(":ID_sede", $datos["ID_sede"], PDO::PARAM_INT);
            $stmt->bindParam(":modalidad", $datos["modalidad"], PDO::PARAM_STR);
            $stmt->bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
            $stmt->bindParam(":nivel_formacion", $datos["nivel_formacion"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_oferta", $datos["tipo_oferta"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin_lec", $datos["fecha_fin_lec"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
    
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
    
    // Editar ficha - CORREGIDO
    static public function mdlEditarFicha($datos) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE fichas 
                                                   SET codigo = :codigo,
                                                       ID_programas = :ID_programas,
                                                       ID_sede = :ID_sede,
                                                       modalidad = :modalidad,
                                                       jornada = :jornada,
                                                       nivel_formacion = :nivel_formacion,
                                                       tipo_oferta = :tipo_oferta,
                                                       fecha_inicio = :fecha_inicio,
                                                       fecha_fin_lec = :fecha_fin_lec,
                                                       fecha_final = :fecha_final
                                                   WHERE ID_Fichas = :idficha");

            $stmt->bindParam(":idficha", $datos["ID_ficha"], PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":ID_programas", $datos["ID_programas"], PDO::PARAM_INT);
            $stmt->bindParam(":ID_sede", $datos["ID_sede"], PDO::PARAM_INT);
            $stmt->bindParam(":modalidad", $datos["modalidad"], PDO::PARAM_STR);
            $stmt->bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
            $stmt->bindParam(":nivel_formacion", $datos["nivel_formacion"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_oferta", $datos["tipo_oferta"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin_lec", $datos["fecha_fin_lec"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);

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

    // Cambiar estado (Activo/Inactivo) - CORREGIDO
    static public function mdlCambiarEstadoFicha($valor, $estado) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE fichas SET estado = :estado WHERE ID_Fichas = :id_ficha");
        
            $stmt->bindParam(":id_ficha", $valor, PDO::PARAM_INT);
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

?>