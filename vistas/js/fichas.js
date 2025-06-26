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
        }
    });

    // Cambio visual del botón (inmediato)
    if (nuevoEstado === "Inactiva") {
        $(this).removeClass("btn-success").addClass("btn-danger").html("Inactiva");
        $(this).attr("nuevoEstado", "Activa");
    } else {
        $(this).removeClass("btn-danger").addClass("btn-success").html("Activa");
        $(this).attr("nuevoEstado", "Inactiva");
    }
});
