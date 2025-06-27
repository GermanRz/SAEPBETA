// ==============================
// Evento para EDITAR ficha
// ==============================
$(document).on('click', '.btnEditarFicha', function () {
    let idFicha = $(this).attr("idFicha");
    console.log("ID de ficha seleccionada:", idFicha);

    let datos = new FormData();
    datos.append("id_ficha", idFicha);

    $.ajax({
        url: "ajax/fichas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("Respuesta ficha:", respuesta);

            $("#editIdFicha").val(respuesta["ID_Fichas"]);
            $("#editCodigoFicha").val(respuesta["codigo"]);
            $("#editProgramaFicha").val(respuesta["ID_programas"]);
            $("#editSedeFicha").val(respuesta["ID_sede"]);
            $("#editModalidadFicha").val(respuesta["modalidad"]);
            $("#editJornadaFicha").val(respuesta["jornada"]);
            $("#editNivelFormacionFicha").val(respuesta["nivel_formacion"]);
            $("#editTipoOfertaFicha").val(respuesta["tipo_oferta"]);
            $("#editFechaInicioFicha").val(respuesta["fecha_inicio"]);
            $("#editFechaFinLecFicha").val(respuesta["fecha_fin_lec"]);
            $("#editFechaFinalFicha").val(respuesta["fecha_final"]);
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            console.error("Respuesta del servidor:", xhr.responseText);
        }
    });
});

// ==============================
// Evento para ACTIVAR/INACTIVAR ficha
// ==============================
$(document).on('click', '.btnActivarFicha', function () {
    let idFichaActivar = $(this).attr("idFichaCambiarEstado");
    let nuevoEstado = $(this).attr("nuevoEstado"); 
    let datos = new FormData();
    datos.append("id_cambiarEstado", idFichaActivar);
    datos.append("estadoFicha", nuevoEstado);

    $.ajax({
        url: "ajax/fichas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log("Estado cambiado:", respuesta);
            
            // Verificar si la respuesta es exitosa
            if (respuesta.includes("ok") || respuesta === '"ok"') {
                // Solo cambiar visualmente si el servidor confirmó el cambio
                if (nuevoEstado === "Inactivo") {
                    $(`button[idFichaCambiarEstado="${idFichaActivar}"]`)
                        .removeClass("btn-success")
                        .addClass("btn-danger")
                        .html("Inactivo")
                        .attr("nuevoEstado", "Activo");
                } else {
                    $(`button[idFichaCambiarEstado="${idFichaActivar}"]`)
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .html("Activo")
                        .attr("nuevoEstado", "Inactivo");
                }
            } else {
                console.error("Error al cambiar estado:", respuesta);
                alert("Error al cambiar el estado de la ficha");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            alert("Error de conexión al cambiar estado");
        }
    });
});

// ==============================
// Validación adicional de formularios
// ==============================
$(document).ready(function() {
    // Validar fechas en modal de agregar
    $('#modalAgregarFicha form').on('submit', function(e) {
        let fechaInicio = new Date($('input[name="fechaInicioFicha"]').val());
        let fechaFinLec = new Date($('input[name="fechaFinLecFicha"]').val());
        let fechaFinal = new Date($('input[name="fechaFinalFicha"]').val());
        
        if (fechaInicio >= fechaFinLec) {
            e.preventDefault();
            alert('La fecha de inicio debe ser anterior a la fecha fin lectiva');
            return false;
        }
        
        if (fechaFinLec >= fechaFinal) {
            e.preventDefault();
            alert('La fecha fin lectiva debe ser anterior a la fecha final');
            return false;
        }
    });
    
    // Validar fechas en modal de editar
    $('#modalEditarFicha form').on('submit', function(e) {
        let fechaInicio = new Date($('#editFechaInicioFicha').val());
        let fechaFinLec = new Date($('#editFechaFinLecFicha').val());
        let fechaFinal = new Date($('#editFechaFinalFicha').val());
        
        if (fechaInicio >= fechaFinLec) {
            e.preventDefault();
            alert('La fecha de inicio debe ser anterior a la fecha fin lectiva');
            return false;
        }
        
        if (fechaFinLec >= fechaFinal) {
            e.preventDefault();
            alert('La fecha fin lectiva debe ser anterior a la fecha final');
            return false;
        }
    });
});