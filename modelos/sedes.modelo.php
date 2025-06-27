<?php

    require_once "conexion.php";

    class ModeloSedes{

        static public function mdlMostrarSedes($dato){

            if($dato == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM sede");

        
                $stmt-> execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM sede WHERE ID_sede = :id_sede");
                $stmt->bindParam(":id_sede", $dato, PDO::PARAM_INT);
        
                $stmt-> execute();
                return $stmt->fetch();                

            }
            
            $stmt->close();
            $stmt = null;

        }//fin de la funcion mdlMostrarProgramas

        static public function mdlIngresarSede($tabla, $datos){
            try {
                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_sede, direccion,estado) VALUES (:nombre_sede, :direccion, 'Activo')");
                $stmt->bindParam(":nombre_sede", $datos["nombre_sede"], PDO::PARAM_STR);
                $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
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

        static public function mdlEditarsede($datos){

                $stmt = Conexion::conectar()->prepare("UPDATE sede SET nombre_sede = :nombreSede, direccion = :direccionSede WHERE ID_sede = :idsede");

                $stmt->bindParam(":nombreSede", $datos["nombre_sede"], PDO::PARAM_STR);
                $stmt->bindParam(":direccionSede", $datos["direccion"], PDO::PARAM_STR);
                $stmt->bindParam(":idsede", $datos["id_sede"], PDO::PARAM_INT);

                if ($stmt->execute()){
                    $stmt->closeCursor();
                    $stmt = null;
                    return "ok";
                }else{
                    $stmt->closeCursor();
                    $stmt = null;
                    return "error";
                }

        }//fin metodo

        static public function mdlCambiarEstadoSede($valor, $estado){

            // UPDATE programas SET estado = $estado WHERE ID_programas = $valor
            $stmt = Conexion::conectar()->prepare("UPDATE sede SET estado = :estado WHERE ID_sede = :id_sede");

            $stmt->bindParam(":id_sede", $valor, PDO::PARAM_INT);
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