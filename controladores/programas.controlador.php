<?php

    class ControladorProgramas{

        /*=============================================
        MOSTRAR PROGRAMAS
        =============================================*/

        static public function ctrMostrarProgramas($valor){

            $respuesta = ModeloProgramas::mdlMostrarProgramas($valor);
            return $respuesta;
            
        }//   fin metodo ctrMostrarProgramas

        /*=============================================
        REGISTRO DE PROGRAMAS
        =============================================*/

        static public function ctrCrearPrograma(){

            if(isset($_POST["descripcionPrograma"]) && isset($_POST["versionPrograma"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["descripcionPrograma"]) &&
                   preg_match('/^[a-zA-Z0-9_.-]+$/', $_POST["versionPrograma"])){

                    $tabla = "programas";
                    $datos = array(
                        "nombre_programa" => $_POST["descripcionPrograma"],
                        "version_programa" => $_POST["versionPrograma"]
                    );

                    $respuesta = ModeloProgramas::mdlIngresarPrograma($tabla, $datos);

                    if($respuesta == "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "El programa ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                window.location = "programas";
                                }
                            })
                        </script>';
                    }
                }
            }
        }//fin metodo


        static public function ctrEditarprograma(){

            if (isset($_POST["editIdPrograma"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editDescripcionPrograma"]) &&
                   preg_match('/^[a-zA-Z0-9_.-]+$/', $_POST["editVersionPrograma"])){ 
                    
                    $datos = array(
                        "id_programa" => $_POST["editIdPrograma"],
                        "descripcion_programa" => $_POST["editDescripcionPrograma"],
                        "version_programa" => $_POST["editVersionPrograma"]
                    );

                    $respuesta = ModeloProgramas::mdlEditarprograma($datos);

                    if ($respuesta = "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "El programa ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                window.location = "programas";
                                }
                            })
                        </script>';                     

                    }
                }//fin pregmatch                   

            }//fin isset

        }//fin metodo


        static public function ctrCambiarEstadoPrograma($valor, $estado){

            $respuesta = ModeloProgramas::mdlCambiarEstadoPrograma($valor, $estado);
            return $respuesta;

        }//fin metodo ctrCambiarEstadoPrograma


    }//fin clase



?>