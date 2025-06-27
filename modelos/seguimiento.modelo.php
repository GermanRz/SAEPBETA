<?php

    require_once "conexion.php";

    class ModeloSeguimiento{

        static public function mdlMostrarSeguimiento($dato){

            if($dato == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM seguimiento");
        
                $stmt-> execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE ID_seguimiento = :id_seguimiento");
                $stmt->bindParam(":id_seguimiento", $dato, PDO::PARAM_INT);
        
                $stmt-> execute();
                return $stmt->fetch();                

            }
            
    
            $stmt->close();
            $stmt = null;

        }//fin de la funcion mdlMostrarTablaSeguimiento


static public function mdlIngresarSeguimiento($tabla, $datos) {
    try {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(nombre_archivo, tipo_formato, observaciones, archivo, fecha) 
             VALUES (:nombre_archivo, :tipo_formato, :observaciones, :archivo, NOW())"
        );
        $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_formato", $datos["tipo_formato"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    } finally {
        $stmt = null;
    }
}

        static public function mdlIngresarPrograma($tabla, $datos){
            try {
                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_programa, version_programa) VALUES (:nombre_programa, :version_programa)");
                $stmt->bindParam(":nombre_programa", $datos["nombre_programa"], PDO::PARAM_STR);
                $stmt->bindParam(":version_programa", $datos["version_programa"], PDO::PARAM_STR);
                if($stmt->execute()){
                    return "ok";
                }else{
                    return "error";
                }
            }catch (Exception $e) {
                return $e->getMessage();
            }finally{
                $stmt -> closeCursor();
                $stmt = null;
            }
        }

        static public function mdlEditarprograma($datos){

                $stmt = Conexion::conectar()->prepare("UPDATE programas SET nombre_programa = :nombrePrograma, version_programa = :versionPrograma WHERE ID_programas = :idprograma");

                $stmt->bindParam(":nombrePrograma", $datos["descripcion_programa"], PDO::PARAM_STR);
                $stmt->bindParam(":versionPrograma", $datos["version_programa"], PDO::PARAM_STR);
                $stmt->bindParam(":idprograma", $datos["id_programa"], PDO::PARAM_INT);

                if ($stmt->execute()){
                    return "ok";
                }else{
                    return "error";
                }

                $stmt->close();
                $stmt = null;    

        }//fin metodo

        static public function mdlCambiarEstadoPrograma($valor, $estado){

            // UPDATE programas SET estado = $estado WHERE ID_programas = $valor
            $stmt = Conexion::conectar()->prepare("UPDATE programas SET estado = :estado WHERE ID_programas = :id_programa");

            $stmt->bindParam(":id_programa", $valor, PDO::PARAM_INT);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

            if ($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
            $stmt->closeCursor();
            $stmt = null;

        }//fin metodo mdlCambiarEstadoPrograma

// MÉTODO PARA EDITAR OBSERVACIÓN DE SEGUIMIENTO
static public function mdlEditarObservacion($id, $observacion) {
    try {
        $stmt = Conexion::conectar()->prepare("UPDATE seguimiento SET observaciones = :observacion WHERE ID_seguimiento = :id");
        $stmt->bindParam(":observacion", $observacion, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    } finally {
        $stmt = null;
    }
}

    }

?>