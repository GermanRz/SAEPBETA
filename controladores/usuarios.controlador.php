<?php

class ControladorUsuarios{

    public function ctrIngresoUsuario(){
        if (isset($_POST["ingEmail"])){
            if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["ingEmail"]) && preg_match("/^[a-zA-Z0-9]+$/",$_POST["ingPassword"])){

                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["ingEmail"];
                    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                    var_dump($valor); // Verifica el correo que llega
                    var_dump($respuesta); // Verifica la respuesta de la consulta
                    
                if ($respuesta) {
               
                    if ($respuesta["email"] == $_POST["ingEmail"] && $respuesta["clave"] == $_POST["ingPassword"] && $respuesta["estado"] == "Activo") {

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["ID_usuarios"] = $respuesta["ID_usuarios"];
                        $_SESSION["nombres"] = $respuesta["nombres"];
                        $_SESSION["apellidos"] = $respuesta["apellidos"];
                        $_SESSION["ID_rol"] = $respuesta["ID_rol"];

                        // Redirecciona al inicio
                        echo '<script>window.location = "inicio";</script>';

                    } else {
                        echo '<div class="alert alert-danger">Contraseña incorrecta o usuario inactivo.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Usuario no encontrado.</div>';
                }

                }//fn del pregmatch

        }



    }//Fin método ingreso de usuario



}//FIN DE CLASE USUARIOS