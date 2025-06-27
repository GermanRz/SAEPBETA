<?php
require_once "conexion.php";

class ModeloEmpresas {

    // Mostrar todas las empresas o una sola por ID
    static public function mdlMostrarEmpresas($dato = null) {
        $stmt = null;

        if ($dato == null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM empresas");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM empresas WHERE id_empresas = :id_empresas");
            $stmt->bindParam(":id_empresas", $dato, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    // Cambiar estado (Activo/Inactivo)
    static public function mdlCambiarEstadoEmpresa($valor, $estado) {
        $stmt = Conexion::conectar()->prepare("UPDATE empresas SET estado = :estado WHERE id_empresas = :id_empresas");
        $stmt->bindParam(":id_empresas", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

        $respuesta = $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
        $stmt = null;
        return $respuesta;
    }

    // Registrar empresa
    public static function mdlRegistrarEmpresa($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("
            INSERT INTO $tabla 
            (nit, nombre, direccion, area, id_usuarios, contacto, email, departamento, ciudad, estado) 
            VALUES 
            (:nit, :nombre, :direccion, :area, :id_usuarios, :contacto, :email, :departamento, :ciudad, :estado)
        ");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuarios", $datos["id_usuarios"], PDO::PARAM_INT);
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

    // Editar empresa usando ID
    public static function mdlEditarEmpresa($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
            nit = :nit,
            nombre = :nombre,
            direccion = :direccion,
            area = :area,
            id_usuarios = :id_usuarios,
            contacto = :contacto,
            email = :email,
            departamento = :departamento,
            ciudad = :ciudad,
            estado = :estado
            WHERE id_empresas = :id_empresas");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuarios", $datos["id_usuarios"], PDO::PARAM_INT);
        $stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresas", $datos["id_empresas"], PDO::PARAM_INT);

        $respuesta = $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
        $stmt = null;
        return $respuesta;
    }

}
?>
