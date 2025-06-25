<?php

require_once "conexion.php";

class ModeloAsignacion {

    static public function mdlMostrarAprendices() {
        $stmt = Conexion::conectar()->prepare("
            SELECT 
                a.ID_numeroAprendices, u.numero, u.nombres, u.apellidos, f.codigo AS ficha,
                e.nombre_empresa, m.modalidad, i.nombres AS nombre_instructor, i.apellidos AS apellido_instructor,
                a.ID_instructor
            FROM aprendices a
            JOIN usuarios u ON a.ID_usuarios = u.ID_usuarios
            LEFT JOIN fichas f ON a.ID_Fichas = f.ID_Fichas
            LEFT JOIN empresas e ON a.ID_empresas = e.ID_empresas
            LEFT JOIN modalidad m ON a.ID_modalidad = m.ID_modalidad
            LEFT JOIN usuarios i ON a.ID_instructor = i.ID_usuarios
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function mdlMostrarEvaluadores() {
        $stmt = Conexion::conectar()->prepare("
            SELECT ID_usuarios, nombres, apellidos, numero
            FROM usuarios
            WHERE ID_rol = 2
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function mdlAsignarEvaluador($idAprendiz, $idEvaluador) {
        $stmt = Conexion::conectar()->prepare("
            UPDATE aprendices
            SET ID_instructor = :idEvaluador
            WHERE ID_numeroAprendices = :idAprendiz
        ");
        $stmt->bindParam(":idEvaluador", $idEvaluador, PDO::PARAM_INT);
        $stmt->bindParam(":idAprendiz", $idAprendiz, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }

    static public function mdlEliminarEvaluador($idAprendiz) {
        $stmt = Conexion::conectar()->prepare("
            UPDATE aprendices
            SET ID_instructor = NULL
            WHERE ID_numeroAprendices = :idAprendiz
        ");
        $stmt->bindParam(":idAprendiz", $idAprendiz, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }
}
