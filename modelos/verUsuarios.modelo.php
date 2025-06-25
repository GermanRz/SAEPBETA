<?php

require_once "conexion.php";

class ModeloVerUsuarios {

    static public function mdlMostrarUsuariosPorTipo($tipo) {
        if ($tipo !== null) {
            $stmt = Conexion::conectar()->prepare("
                SELECT u.ID_usuarios, u.tipo_dc, u.numero, u.nombres, u.apellidos,
                    u.email, u.email_insti, u.direccion, u.contacto1, u.estado,
                    r.rol AS nombre_rol
                FROM usuarios u
                INNER JOIN rol r ON u.ID_rol = r.ID_rol
                WHERE u.ID_rol = :tipo
            ");
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
        } else {
            $stmt = Conexion::conectar()->prepare("
                SELECT u.ID_usuarios, u.tipo_dc, u.numero, u.nombres, u.apellidos,
                    u.email, u.email_insti, u.direccion, u.contacto1, u.estado,
                    r.rol AS nombre_rol
                FROM usuarios u
                INNER JOIN rol r ON u.ID_rol = r.ID_rol
            ");
        }

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
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
