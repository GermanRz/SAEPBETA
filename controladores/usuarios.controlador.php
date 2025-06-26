<?php

class ControladorUsuarios {

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    static public function ctrMostrarUsuarios($valor) {
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($valor);
        return $respuesta;
    }

    public function ctrIngresoUsuario(){
        if (isset($_POST["ingEmail"])){
            if (
                preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["ingEmail"]) &&
                preg_match("/^[a-zA-Z0-9]+$/", $_POST["ingPassword"])
            ) {
    
                $email = $_POST["ingEmail"];
                $password = $_POST["ingPassword"];
    
                // Nuevo método que busca por correo
                $respuesta = ModeloUsuarios::mdlMostrarUsuarioPorCorreo($email);
    
                if ($respuesta && 
                    $respuesta["email"] == $email && 
                    $respuesta["clave"] == $password && 
                    $respuesta["estado"] == "Activo") {
    
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["idUsuario"] = $respuesta["ID_usuarios"];
                    $_SESSION["nombres"] = $respuesta["nombres"];
                    $_SESSION["apellidos"] = $respuesta["apellidos"];
                    $_SESSION["idRol"] = $respuesta["ID_rol"];
    
                    echo '<script>window.location = "inicio";</script>';
    
                } else {
                    echo '<div class="alert alert-danger mt-2">Credenciales incorrectas o usuario inactivo</div>';
                }
            }
        }
    }
    
    /*=============================================
    REGISTRO DE USUARIOS
    =============================================*/
    static public function ctrCrearUsuario() {

        if (isset($_POST["nombres"]) && isset($_POST["numero"])) {

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"]) &&
                preg_match('/^[0-9]+$/', $_POST["numero"])) {

                $tabla = "usuarios";

                $datos = array(
                    "tipo_dc" => $_POST["tipo_dc"],
                    "numero" => $_POST["numero"],
                    "nombres" => $_POST["nombres"],
                    "apellidos" => $_POST["apellidos"],
                    "email" => $_POST["email"],
                    "email_insti" => $_POST["email_insti"],
                    "direccion" => $_POST["direccion"],
                    "contacto1" => $_POST["contacto1"],
                    "contacto2" => $_POST["contacto2"],
                    "clave" => $_POST["clave"], // Se recomienda encriptarla
                    "estado" => "activo",
                    "ID_rol" => $_POST["ID_rol"]
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El usuario ha sido guardado correctamente",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }

            }

        }

    }

    /*=============================================
    EDITAR USUARIO
    =============================================*/
    static public function ctrEditarUsuario() {

        if (isset($_POST["editIdUsuario"])) {

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editNombres"]) &&
                preg_match('/^[0-9]+$/', $_POST["editNumero"])) {

                $datos = array(
                    "ID_usuarios" => $_POST["editIdUsuario"],
                    "tipo_dc" => $_POST["editTipoDc"],
                    "numero" => $_POST["editNumero"],
                    "nombres" => $_POST["editNombres"],
                    "apellidos" => $_POST["editApellidos"],
                    "email" => $_POST["editEmail"],
                    "email_insti" => $_POST["editEmailInsti"],
                    "direccion" => $_POST["editDireccion"],
                    "contacto1" => $_POST["editContacto1"],
                    "contacto2" => $_POST["editContacto2"],
                    "ID_rol" => $_POST["editRol"]
                );

                $respuesta = ModeloUsuarios::mdlEditarUsuario($datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El usuario ha sido editado correctamente",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }
            }

        }

    }

    /*=============================================
    CAMBIAR ESTADO DEL USUARIO
    =============================================*/
    static public function ctrCambiarEstadoUsuario($valor, $estado) {
        $respuesta = ModeloUsuarios::mdlCambiarEstadoUsuario($valor, $estado);
        return $respuesta;
    }

}
?>
