<?php

    class ControladorSedes{

        /*=============================================
        MOSTRAR SEDES
        =============================================*/

        static public function ctrMostrarSedes($valor){

            $respuesta = ModeloSedes::mdlMostrarSedes($valor);
           
            return $respuesta;
            
        }//   fin metodo ctrMostrarProgramas

        /*=============================================
        REGISTRO DE SEDES
        =============================================*/

        static public function ctrCrearSedes(){

            if(isset($_POST["nombreSede"]) && isset($_POST["DireccionSede"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nombreSede"]) &&
                   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.#\-]+$/', $_POST["DireccionSede"])){

                    $tabla = "sede";
                    $datos = array(
                        "nombre_sede" => $_POST["nombreSede"],
                        "direccion" => $_POST["DireccionSede"],
                    );

                    $respuesta = ModeloSedes::mdlIngresarSede($tabla, $datos);

                    if($respuesta == "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "La Sede ha sido guardada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                window.location = "sedes";
                                }
                            })
                        </script>';
                    }
                }
            }
        }//fin metodo


        static public function ctrEditarsede(){

            if (isset($_POST["editIdSede"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editnombreSede"]) &&
                   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.#\-]+$/', $_POST["editDireccionSede"])){ 
                    
                    $datos = array(
                        "id_sede" => $_POST["editIdSede"],
                        "nombre_sede" => $_POST["editnombreSede"],
                        "direccion" => $_POST["editDireccionSede"]
                    );

                    $respuesta = ModeloSedes::mdlEditarsede($datos);

                    if ($respuesta = "ok"){
                        echo '<script>
                        swal.fire({
                            type: "success",
                            title: "La sede ha sido editada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                window.location = "sedes";
                                }
                            })
                        </script>';                     

                    }
                }//fin pregmatch                   

            }//fin isset

        }//fin metodo


        static public function ctrCambiarEstadoSede($valor, $estado){

            $respuesta = ModeloSedes::mdlCambiarEstadoSede($valor, $estado);
            return $respuesta;

        }//fin metodo ctrCambiarEstadoPrograma


    }//fin clase



?>