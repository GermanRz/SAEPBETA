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

}
