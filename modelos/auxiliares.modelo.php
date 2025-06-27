<?php

require_once "conexion.php";

class ModeloAuxiliares {

    static public function mdlMostrarAuxiliares() {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u 
            INNER JOIN rol r ON u.ID_rol = r.ID_rol 
            WHERE u.ID_rol = 4
        ");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }
    
    static public function mdlActualizarEstadoUsuario($id, $estado) {
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET estado = :estado WHERE ID_usuarios = :id");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

}
