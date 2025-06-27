<?php
require_once "../modelos/conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nit = $_POST['editNit'] ?? '';
    $nombre = $_POST['editNombre'] ?? '';
    $telefono = $_POST['editContacto'] ?? '';
    $email = $_POST['editEmail'] ?? '';
    $direccion = $_POST['editDireccion'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $area = $_POST['editArea'] ?? '';
    $coevaluador = $_POST['editCoevaluador'] ?? '';
    $estado = $_POST['editEstado'] ?? '';

    try {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE empresas 
    SET nit = :nit, nombre = :nombre, contacto = :contacto, email = :email, 
        direccion = :direccion, departamento = :departamento, ciudad = :ciudad, 
        area = :area, estado = :estado, id_usuarios = :coevaluador
    WHERE id_empresas = :id");

        $stmt->bindParam(':nit', $nit);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contacto', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':coevaluador', $coevaluador);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se actualizó ningún registro.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
