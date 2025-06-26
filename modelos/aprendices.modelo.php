<?php

require_once "conexion.php";

class ModeloAprendices {

    static public function mdlMostrarAprendices() {
        $stmt = Conexion::conectar()->prepare("
            SELECT u.*, r.rol 
            FROM usuarios u 
            INNER JOIN rol r ON u.ID_rol = r.ID_rol 
            WHERE u.ID_rol = 1
        ");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }
    static public function mdlInsertarAprendiz($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_ficha, id_empresa, id_evaluador, modalidad)
          VALUES (:id_usuario, :id_ficha, :id_empresa, :id_evaluador, :modalidad)");
      
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);
        $stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":id_evaluador", $datos["id_evaluador"], PDO::PARAM_INT);
        $stmt->bindParam(":modalidad", $datos["modalidad"], PDO::PARAM_STR);
      
        if ($stmt->execute()) {
          return "ok";
        } else {
          return "error";
        }
      }
      
}

?>
