<?php

    require_once "conexion.php";

    class ModeloProgramas{

        static public function mdlMostrarProgramas($dato){

            if($dato == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM programas");
        
                $stmt-> execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM programas WHERE ID_programas = :id_programa");
                $stmt->bindParam(":id_programa", $dato, PDO::PARAM_INT);
        
                $stmt-> execute();
                return $stmt->fetch();                

            }
            
    
            $stmt->close();
            $stmt = null;

        }//fin de la funcion mdlMostrarProgramas

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



    }

?>