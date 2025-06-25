<?php



class ControladorSeguimiento
{

    /*=============================================
        MOSTRAR DATOS DEL SEGUIMIENTO
        =============================================*/

    static public function ctrMostrarSeguimiento($valor)
    {

        $respuesta = ModeloSeguimiento::mdlMostrarSeguimiento($valor);
        return $respuesta;
    } //   fin metodo ctrMostrarSeguimiento




  static public function ctrCrearSeguimiento()
{
    if (isset($_FILES["archivoPrograma"]) && isset($_POST["descripcionObservacion"])) {

        $archivoNombre = $_FILES["archivoPrograma"]["name"];
        $archivoTemp = $_FILES["archivoPrograma"]["tmp_name"];

        // Ruta donde guardar el archivo (carpeta 'uploads' en la raíz del proyecto)
        $carpetaDestino = "uploads/";
        $rutaArchivo = $carpetaDestino . basename($archivoNombre);

        if (move_uploaded_file($archivoTemp, $rutaArchivo)) {

            $tabla = "seguimiento";
            $datos = array(
                "nombre_archivo" => $archivoNombre,
                "tipo_formato" => "147", // o ajusta si tienes otro valor
                "observaciones" => $_POST["descripcionObservacion"],
                "archivo" => $rutaArchivo
            );

            $respuesta = ModeloSeguimiento::mdlIngresarSeguimiento($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "PDF subido exitosamente",
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "seguimiento";
                        }
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error al subir el archivo",
                    confirmButtonText: "Cerrar"
                });
            </script>';
        }
    }
}

/*=============================================
    EDITAR OBSERVACIÓN
=============================================*/
static public function ctrEditarObservacion($id, $observacion)
{
    $respuesta = ModeloSeguimiento::mdlEditarObservacion($id, $observacion);
    return $respuesta;
}


    static public function ctrCambiarEstadoPrograma($valor, $estado)
    {

        $respuesta = ModeloProgramas::mdlCambiarEstadoPrograma($valor, $estado);
        return $respuesta;
    } //fin metodo ctrCambiarEstadoPrograma


} //fin clase
 //fin clase
