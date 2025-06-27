<?php

class ControladorCoevaluadores {

    static public function ctrMostrarCoevaluadores() {
        $respuesta = ModeloCoevaluadores::mdlMostrarCoevaluadores();
        return $respuesta;
    }

    // ✅ AGREGADO: Método para mostrar un coevaluador específico
    static public function ctrMostrarCoevaluador($valor) {
        $respuesta = ModeloCoevaluadores::mdlMostrarCoevaluador($valor);
        return $respuesta;
    }

    // Crear Coevaluador
    static public function ctrCrearCoevaluadores() {
        if ( isset($_POST["tipoDc"]) &&
         isset($_POST["numero"]) &&
         isset($_POST["nombres"]) &&
         isset($_POST["apellidos"]) &&
         isset($_POST["email"]) &&
         isset($_POST["emailInsti"]) &&
         isset($_POST["direccion"]) &&
         isset($_POST["contacto1"]) &&
         isset($_POST["contacto2"]) &&
         isset($_POST["clave"])) 
         {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["tipoDc"]) &&
                preg_match('/^[0-9]+$/', $_POST["numero"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["nombres"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["apellidos"]) &&
                preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["email"]) &&
                preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["emailInsti"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s#. -]{5,100}$/', $_POST["direccion"])&&
                preg_match('/^[0-9]{7,15}$/', $_POST["contacto1"])&&
                preg_match('/^[0-9]{7,15}$/', $_POST["contacto2"])&&
                preg_match('/^[a-zA-Z0-9@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]{6,50}$/', $_POST["clave"])
             ) 
            {
               $tabla = "usuarios";
               
               $datos = array(
                "tipo_dc"           => $_POST["tipoDc"],
                "numero"     => $_POST["numero"],
                "nombres"          => $_POST["nombres"],
                "apellidos"        => $_POST["apellidos"],
                "email"          => $_POST["email"],
                "email_insti"  => $_POST["emailInsti"],
                "direccion"      => $_POST["direccion"],
                "contacto1"     => $_POST["contacto1"],
                "contacto2"    => $_POST["contacto2"],
                "clave"      => $_POST["clave"]
             );
            
             $respuesta = ModeloCoevaluadores::mdlIngresarCoevaluador($tabla, $datos);

             if ($respuesta == "ok") {
                 echo '<script>
                 Swal.fire({
                    icon: "success",
                    title: "Coevaluador creado correctamente",
                    confirmButtonText: "Cerrar"
                 }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "coevaluadores";
                    }
                 });
                 </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                       icon: "error",
                       title: "Error al crear el coevaluador",
                       text: "' . $respuesta . '",
                       confirmButtonText: "Cerrar"
                    });
                    </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                   icon: "error",
                   title: "Error de validación",
                   text: "Por favor verifica que todos los campos estén correctamente diligenciados",
                   confirmButtonText: "Cerrar"
                });
                </script>';
            }
        }
    }

    // ✅ CORREGIDO: Editar Coevaluador con validación opcional de contraseña
static public function ctrEditarCoevaluador() {
    if (isset($_POST["EditIdCoevaluador"])) {
        // Validar campos obligatorios
        if (
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["EditIdTipoDc"]) &&
            preg_match('/^[0-9]+$/', $_POST["EditIdNumero"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["EditIdNombres"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s ]{2,50}$/', $_POST["EditIdApellidos"]) &&
            preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["EditIdEmail"]) &&
            preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["EditIdEmailInsti"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s#. -]{5,100}$/', $_POST["EditIdDireccion"]) &&
            preg_match('/^[0-9]{7,15}$/', $_POST["EditIdContacto1"]) &&
            preg_match('/^[0-9]{7,15}$/', $_POST["EditIdContacto2"])
        ) {
            // ✅ Validar contraseña solo si no está vacía
            $claveValida = true;
            if (!empty($_POST["EditIdClave"])) {
                $claveValida = preg_match('/^[a-zA-Z0-9@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]{6,50}$/', $_POST["EditIdClave"]);
            }

            if ($claveValida) {
                $datos = array(
                    "ID_usuarios"   => $_POST["EditIdCoevaluador"],
                    "tipo_dc"       => $_POST["EditIdTipoDc"],
                    "numero"        => $_POST["EditIdNumero"],
                    "nombres"       => $_POST["EditIdNombres"],
                    "apellidos"     => $_POST["EditIdApellidos"],
                    "email"         => $_POST["EditIdEmail"],
                    "email_insti"   => $_POST["EditIdEmailInsti"],
                    "direccion"     => $_POST["EditIdDireccion"],
                    "contacto1"     => $_POST["EditIdContacto1"],
                    "contacto2"     => $_POST["EditIdContacto2"],
                    "clave"         => $_POST["EditIdClave"] // Puede estar vacía
                );

                $respuesta = ModeloCoevaluadores::mdlEditarCoevaluador($datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Coevaluador editado correctamente",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "coevaluadores";
                        }
                    });
                    </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al editar el coevaluador",
                        text: "' . $respuesta . '",
                        confirmButtonText: "Cerrar"
                    });
                    </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error de validación",
                    text: "La contraseña debe tener entre 6 y 50 caracteres",
                    confirmButtonText: "Cerrar"
                });
                </script>';
            }
        } else {
            echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error de validación",
                text: "Por favor verifica que todos los campos estén correctamente diligenciados",
                confirmButtonText: "Cerrar"
            });
            </script>';
        }
    }
}

    // Cambiar estado ficha (Activo/Inactivo)
    static public function ctrCambiarEstadoCoevaluadar($valor, $estado) {
        $respuesta = ModeloCoevaluadores::mdlCambiarEstadoCoevaludar($valor, $estado);
        return $respuesta;
    }
}