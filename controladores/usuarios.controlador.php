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
            if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["ingEmail"]) && preg_match("/^[a-zA-Z0-9]+$/",$_POST["ingPassword"])){


                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["ingEmail"];

                    $respuesta=ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
                    //var_dump($respuesta);
                    
                     if ($respuesta && $respuesta["clave"] == $_POST["ingPassword"]) {
                        if ($respuesta["estado"] == "Activo") {
                          
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }  
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["idUsuario"]=$respuesta["ID_usuarios"];
                            $_SESSION["nombres"]=$respuesta["nombres"];
                            $_SESSION["apellidos"]=$respuesta["apellidos"];
                            $_SESSION["idRol"]=$respuesta["ID_rol"];
                            $_SESSION["email"] = $respuesta["email"]; 
                       
                            $nombreRol = "";
                            switch($respuesta["ID_rol"]) {
                            case 1: 
                            $nombreRol = "aprendiz";
                            break;
                            case 2:
                            $nombreRol = "instructor";
                            break;

                            default:
                            $nombreRol = "usuario";
                            }
                            $_SESSION["rol"] = $nombreRol;
                       
                            if ($_SESSION["idRol"] == 1) {
                         
                                $progreso = ModeloUsuarios::mdlObtenerProgresoAprendiz($_SESSION["idUsuario"]);
                                
                                $_SESSION["progreso"] = $progreso["porcentaje_completado"];
                                $_SESSION["fecha_inicio"] = date("d/m/Y", strtotime($progreso["fecha_inicio"]));
                                $_SESSION["fecha_fin"] = date("d/m/Y", strtotime($progreso["fecha_fin"]));
                                $_SESSION["programa"] = $progreso["nombre_programa"];
                                $_SESSION["sede"] = $progreso["nombre_sede"];
                                $_SESSION["modalidad"] = $progreso["modalidad_formacion"];
                                
                     
                                $_SESSION["novedades"] = ModeloUsuarios::mdlObtenerNovedadesAprendiz($_SESSION["idUsuario"]);
                            }
                            echo '<script>window.location = "inicio";</script>';
                        }else {
                            echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Cuenta inactiva",
                                    text: "Por favor contacta al administrador"
                                });
                            </script>';
                            }
                    } else {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Usuario o contraseña incorrectos"
                            });
                        </script>';
                    }

                }//fn del pregmatch
                 else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error de formato",
                        text: "El email o la contraseña no cumplen el formato requerido."
                    });
                </script>';
            }

        }



    }//Fin método ingreso de usuario


     // Nuevo método para mostrar datos del usuario actual
    static public function ctrMostrarUsuarioActual(){
        if(isset($_SESSION["idUsuario"])){
            $tabla = "usuarios";
            $id = $_SESSION["idUsuario"];

            $respuesta = ModeloUsuarios::mdlMostrarUsuarioPorId($tabla, $id);
            return $respuesta;
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


                    return "ok";
                } else {

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
                    return "error";

                }

            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "editarperfil";
                        }
                    });
                </script>';
                return "error";

            }

        }

        return null;
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
