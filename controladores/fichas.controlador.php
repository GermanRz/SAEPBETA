<?php

class ControladorFichas {

    // Mostrar fichas
   
static public function ctrMostrarFichas($valor = null) {
    $respuesta = ModeloFichas::mdlMostrarFichas($valor);
    return $respuesta;
}

    // Crear ficha
    static public function ctrCrearFicha() {
        if ( isset($_POST["codigoFicha"]) &&
         isset($_POST["programaFicha"]) &&
         isset($_POST["sedeFicha"]) &&
         isset($_POST["modalidadFicha"]) &&
         isset($_POST["jornadaFicha"]) &&
         isset($_POST["nivelFormacionFicha"]) &&
         isset($_POST["tipoOfertaFicha"]) &&
         isset($_POST["fechaInicioFicha"]) &&
         isset($_POST["fechaFinLecFicha"]) &&
         isset($_POST["fechaFinalFicha"])) 
         {
            if (
                preg_match('/^[0-9]+$/', $_POST["codigoFicha"]) &&
                preg_match('/^[0-9]+$/', $_POST["programaFicha"]) &&
                preg_match('/^[0-9]+$/', $_POST["sedeFicha"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["modalidadFicha"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["jornadaFicha"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nivelFormacionFicha"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tipoOfertaFicha"])&&
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["fechaInicioFicha"])&&
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["fechaFinLecFicha"])&&
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["fechaFinalFicha"])


             ) 
            
             {
               $tabla = "fichas"; 
               $datos = array(
                "codigo"           => $_POST["codigoFicha"],
                "ID_programas"     => $_POST["programaFicha"],
                "ID_sede"          => $_POST["sedeFicha"],
                "modalidad"        => $_POST["modalidadFicha"],
                "jornada"          => $_POST["jornadaFicha"],
                "nivel_formacion"  => $_POST["nivelFormacionFicha"],
                "tipo_oferta"      => $_POST["tipoOfertaFicha"],
                "fecha_inicio"     => $_POST["fechaInicioFicha"],
                "fecha_fin_lec"    => $_POST["fechaFinLecFicha"],
                "fecha_final"      => $_POST["fechaFinalFicha"]
             );
            
             $respuesta = ModeloFichas::mdlIngresarFicha($tabla, $datos);

             if ($respuesta == "ok") 
               {
                 echo '<script>
                 Swal.fire({
                    icon: "success",
                    title: "Ficha creada correctamente",
                    confirmButtonText: "Cerrar"
                 }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "fichas";
                    }
                 });
                 </script>';
                }
            }
        }
    }

    // Editar ficha
    static public function ctrEditarFicha() {
        if (isset($_POST["editIdFicha"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["editIdFicha"]) && // ID de la ficha
                preg_match('/^[0-9]+$/', $_POST["editCodigoFicha"]) && // Código numérico
                preg_match('/^[0-9]+$/', $_POST["editProgramaFicha"]) && // ID del programa
                preg_match('/^[0-9]+$/', $_POST["editSedeFicha"]) && // ID de la sede
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editModalidadFicha"]) && // Modalidad
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editJornadaFicha"]) && // Jornada
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editNivelFormacionFicha"]) && // Nivel de formación
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editTipoOfertaFicha"]) && // Tipo de oferta
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["editFechaInicioFicha"]) && // Fecha inicio
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["editFechaFinLecFicha"]) && // Fecha fin lectiva
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["editFechaFinalFicha"]) // Fecha final
             ){
                $datos = array(
                    "ID_ficha"         => $_POST["editIdFicha"],
                    "codigo"           => $_POST["editCodigoFicha"],
                    "ID_programas"     => $_POST["editProgramaFicha"],
                    "ID_sede"          => $_POST["editSedeFicha"],
                    "modalidad"        => $_POST["editModalidadFicha"],
                    "jornada"          => $_POST["editJornadaFicha"],
                    "nivel_formacion"  => $_POST["editNivelFormacionFicha"],
                    "tipo_oferta"      => $_POST["editTipoOfertaFicha"],
                    "fecha_inicio"     => $_POST["editFechaInicioFicha"],
                    "fecha_fin_lec"    => $_POST["editFechaFinLecFicha"],
                    "fecha_final"      => $_POST["editFechaFinalFicha"]
                );
    
                $respuesta = ModeloFichas::mdlEditarFicha($datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Ficha actualizada correctamente",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "fichas";
                        }
                    });
                    </script>';
                }
            
           
           
            }
        }
    }

    // Cambiar estado ficha (Activo/Inactivo)
    static public function ctrCambiarEstadoFicha($valor, $estado) {
        $respuesta = ModeloFichas::mdlCambiarEstadoFicha($valor, $estado);
        return $respuesta;
    }

}

?>
