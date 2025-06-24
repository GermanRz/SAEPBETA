<?php
require_once "conexion.php";

if (!class_exists('Conexion')) {
    require_once __DIR__ . "/conexion.php";
}

class ModeloEmpresas {

    static public function mdlMostrarEmpresas($dato = null) {
        if ($dato == null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM empresas");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM empresas WHERE ID_empresas = :ID_empresas");
            $stmt->bindParam(":ID_empresas", $dato, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    static public function mdlCambiarEstadoEmpresa($valor, $estado) {
        $stmt = Conexion::conectar()->prepare("UPDATE empresas SET estado = :estado WHERE ID_empresas = :ID_empresas");
        $stmt->bindParam(":ID_empresas", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

        $respuesta = $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
        $stmt = null;
        return $respuesta;
    }

    public static function mdlRegistrarEmpresa($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("
            INSERT INTO $tabla 
        (nit, nombre_empresa, direccion, area, ID_usuarios, contacto, email, departamento, ciudad, estado) 
        VALUES 
        (:nit, :nombre_empresa, :direccion, :area, :ID_usuarios, :contacto, :email, :departamento, :ciudad, :estado)

        ");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_empresa", $datos["nombre_empresa"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
       $stmt->bindParam(":ID_usuarios", $datos["coevaluador"], PDO::PARAM_INT); // <-- este cambia
        $stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        $respuesta = $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
        $stmt = null;
        return $respuesta;
    }

}
?>