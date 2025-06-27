
<?php

require_once "conexion.php";


class ModeloEmpresas{

    static public function mdlMostrarEmpresas($tabla, $item, $valor){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE email = :email ");
        $stmt->bindParam(":email", $valor, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;
    }

    // Nuevo método para obtener usuario por ID para EDITAR PERFIL
    static public function mdlMostrarEmpresasPorId($tabla, $id){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE ID_empresas = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;
    }

    // Nuevo método para actualizar usuario
    static public function mdlEditarEmpresas($tabla, $datos){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("UPDATE $tabla SET 
            nit = :nit,
            nombre = :nombre,
            direccion = :direccion,
            area = :area,
            email = :email,
            coevaluador  = :coevaluador,
            contacto = :contacto,
            departamento = :departamento,
            ciudad  = :ciudad,
            estado  = :estado 
            WHERE id_empresas = :id");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":coevaluador", $datos["coevaluador"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
        $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
    

    

}//FIN CLASE ModeloEmpresas
