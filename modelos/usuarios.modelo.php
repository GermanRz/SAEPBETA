<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function mdlMostrarUsuarios($tabla, $item, $valor){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE email = :email ");
        $stmt->bindParam(":email", $valor, PDO::PARAM_STR);

        $stmt-> execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;

    }

   
    // Nuevo método para obtener usuario por ID para EDITAR PERFIL
    static public function mdlMostrarUsuarioPorId($tabla, $id){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE ID_usuarios = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->close();
        $stmt = null;
    }

    // NUEVO MÉTODO: Obtener datos específicos del aprendiz para edición de perfil
    static public function mdlObtenerDatosAprendiz($idUsuario){
        try {
            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("SELECT 
                a.ID_numeroAprendices,
                a.estado as estado_formativo,
                a.ID_Fichas,
                a.ID_empresas,
                a.ID_instructor,
                a.ID_modalidad,
                m.modalidad,
                f.codigo as codigo_ficha,
                p.nombre_programa,
                e.nombre_empresa
            FROM aprendices a
            LEFT JOIN modalidad m ON a.ID_modalidad = m.ID_modalidad
            LEFT JOIN fichas f ON a.ID_Fichas = f.ID_Fichas
            LEFT JOIN programas p ON f.ID_programas = p.ID_programas
            LEFT JOIN empresas e ON a.ID_empresas = e.ID_empresas
            WHERE a.ID_usuarios = :id_usuario");
            
            $stmt->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerDatosAprendiz: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    // NUEVO MÉTODO: Obtener todas las modalidades para el select
    static public function mdlObtenerModalidades(){
        try {
            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("SELECT ID_modalidad, modalidad FROM modalidad ORDER BY modalidad");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerModalidades: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    // NUEVO MÉTODO: Obtener todas las fichas activas para el select
    static public function mdlObtenerFichas(){
        try {
            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("SELECT 
                f.ID_Fichas, 
                f.codigo, 
                p.nombre_programa 
            FROM fichas f 
            LEFT JOIN programas p ON f.ID_programas = p.ID_programas 
            WHERE f.estado = 'Activa' 
            ORDER BY f.codigo");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerFichas: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    // NUEVO MÉTODO: Obtener todas las empresas activas para el select
    static public function mdlObtenerEmpresas(){
        try {
            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("SELECT ID_empresas, nombre_empresa FROM empresas WHERE estado = 'Activa' ORDER BY nombre_empresa");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerEmpresas: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    // Método para actualizar usuario (MODIFICADO para incluir datos de aprendiz)
    static public function mdlEditarUsuario($tabla, $datos){
        $conexion = Conexion::conectar();

        $stmt = $conexion->prepare("UPDATE $tabla SET 
            nombres = :nombres,
            apellidos = :apellidos,
            tipo_dc = :tipo_dc,
            numero = :numero,
            email = :email,
            email_insti = :email_insti,
            direccion = :direccion,
            contacto1 = :contacto1,
            estado = :estado,
            ID_rol = :id_rol
            WHERE ID_usuarios = :id");

        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_dc", $datos["tipo_dc"], PDO::PARAM_STR);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":email_insti", $datos["email_insti"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto1", $datos["contacto1"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    // NUEVO MÉTODO: Actualizar datos específicos del aprendiz
    static public function mdlActualizarDatosAprendiz($datos){
        try {
            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("UPDATE aprendices SET 
                estado = :estado_formativo,
                ID_Fichas = :id_ficha,
                ID_empresas = :id_empresa,
                ID_modalidad = :id_modalidad
                WHERE ID_usuarios = :id_usuario");

            $stmt->bindParam(":estado_formativo", $datos["estado_formativo"], PDO::PARAM_STR);
            $stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);
            $stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
            $stmt->bindParam(":id_modalidad", $datos["id_modalidad"], PDO::PARAM_INT);
            $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            } else {
                return "error";
            }
            
        } catch (PDOException $e) {
            error_log("Error en mdlActualizarDatosAprendiz: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null;
        }
    }


    /*=============================================
    OBTENER PROGRESO DEL APRENDIZ
    =============================================*/
    static public function mdlObtenerProgresoAprendiz($idAprendiz) {
        try {
            // Consulta para obtener el progreso basado en la ficha del aprendiz
            $stmt = Conexion::conectar()->prepare(
                "SELECT 
                    f.fecha_inicio,
                    f.fecha_final AS fecha_fin,
                    ROUND(
                        (DATEDIFF(CURDATE(), f.fecha_inicio) / 
                        NULLIF(DATEDIFF(f.fecha_final, f.fecha_inicio), 0) * 100), 0
                    ) AS porcentaje_completado,
                    p.nombre_programa,
                    s.nombre_sede,
                    m.modalidad AS modalidad_formacion
                FROM aprendices a
                JOIN fichas f ON a.ID_Fichas = f.ID_Fichas
                JOIN programas p ON f.ID_programas = p.ID_programas
                JOIN sede s ON f.ID_sede = s.ID_sede
                JOIN modalidad m ON a.ID_modalidad = m.ID_modalidad
                WHERE a.ID_usuarios = :id_aprendiz
                AND a.estado = 'En curso'"
            );
            
            $stmt->bindParam(":id_aprendiz", $idAprendiz, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Validar y ajustar porcentaje
            if($resultado) {
                $porcentaje = $resultado['porcentaje_completado'];
                $resultado['porcentaje_completado'] = min(max($porcentaje, 0), 100);
                return $resultado;
            }
            
            // Valores por defecto si no hay ficha asignada
            return [
                'porcentaje_completado' => 0,
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                'nombre_programa' => 'Programa no asignado',
                'nombre_sede' => 'Sede no asignada',
                'modalidad_formacion' => 'Modalidad no asignada'
            ];
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerProgresoAprendiz: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    OBTENER NOVEDADES DEL APRENDIZ
    =============================================*/
    static public function mdlObtenerNovedadesAprendiz($idAprendiz) {
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT n.novedad, n.fecha 
                FROM novedades n
                JOIN aprendices a ON n.ID_aprendiz = a.ID_numeroAprendices
                WHERE a.ID_usuarios = :id_aprendiz
                ORDER BY n.fecha DESC
                LIMIT 5"
            );
            
            $stmt->bindParam(":id_aprendiz", $idAprendiz, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en mdlObtenerNovedadesAprendiz: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
        }
    }
}//FIN CLASE ModeloUsuarios