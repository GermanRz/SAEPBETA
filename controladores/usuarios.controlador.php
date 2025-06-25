<?php

class ControladorUsuarios{

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
        return null;
    }

    // Nuevo método para editar usuario
    public function ctrEditarUsuario(){
        if(isset($_POST["editarUsuario"])){
            
            // Validaciones básicas
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"]) &&
               preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidos"]) &&
               preg_match('/^[0-9]+$/', $_POST["identificacion"]) &&
               preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["email"]) &&
               preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["emailInstitucional"])){

                $tabla = "usuarios";

                $datos = array(
                    "id" => $_SESSION["idUsuario"],
                    "nombres" => $_POST["nombres"],
                    "apellidos" => $_POST["apellidos"],
                    "tipo_dc" => $_POST["tipoDocumento"],
                    "numero" => $_POST["identificacion"],
                    "email" => $_POST["email"],
                    "email_insti" => $_POST["emailInstitucional"],
                    "direccion" => $_POST["direccion"],
                    "contacto1" => $_POST["contacto"],
                    "estado" => $_POST["estado"],
                    "id_rol" => $_POST["rol"]
                );

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if($respuesta == "ok"){
                    // Actualizar datos de sesión
                    $_SESSION["nombres"] = $_POST["nombres"];
                    $_SESSION["apellidos"] = $_POST["apellidos"];
                    
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El usuario ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "editarperfil";
                            }
                        });
                    </script>';

                    return "ok";
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error al editar el usuario!",
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



}//FIN DE CLASE USUARIOS