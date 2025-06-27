<?php

require_once "modelos/aprendices.modelo.php";

class ControladorAprendices {

    static public function ctrMostrarAprendices() {
        $respuesta = ModeloAprendices::mdlMostrarAprendices();
        return $respuesta;
    }
    public function ctrCrearAprendiz() {
        if (isset($_POST["nombre"])) {
      
          // Paso 1: Guardar en tabla usuarios
          $datosUsuario = array(
            "nombre" => $_POST["nombre"],
            "apellido" => $_POST["apellido"],
            "documento" => $_POST["documento"],
            "correo" => $_POST["correo"],
            "usuario" => $_POST["usuario"],
            "password" => $_POST["password"],
            "id_rol" => $_POST["id_rol"],
            "estado" => "Activo"
          );
      
          $idNuevoUsuario = ModeloAprendices::mdlInsertarAprendiz("usuarios", $datosUsuario);
      
          // Si se insertó el usuario correctamente
          if ($idNuevoUsuario > 0) {
      
            // Paso 2: Guardar datos del aprendiz
            $datosAprendiz = array(
              "id_usuario" => $idNuevoUsuario,
              "id_ficha" => $_POST["id_ficha"],
              "id_empresa" => $_POST["id_empresa"],
              "id_evaluador" => $_POST["id_evaluador"],
              "modalidad" => $_POST["modalidad"]
            );
      
            $respuesta = ModeloAprendices::mdlInsertarAprendiz("aprendices", $datosAprendiz);
      
            if ($respuesta == "ok") {
              echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "¡Aprendiz registrado correctamente!",
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location = "aprendices";
                });
              </script>';
            }
          }
        }
      }
      
}

?>

