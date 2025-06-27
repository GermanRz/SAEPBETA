// ==============================
// Evento para EDITAR Coevaluador
// ==============================
$(document).on('click', '.btnEditarCoevaluador', function () {
    let idCoevaluador = $(this).attr("idUsuario");
    console.log("ID de coevaluador seleccionado:", idCoevaluador);

    let datos = new FormData();
    datos.append("id_usuarios", idCoevaluador);

    $.ajax({
        url: "ajax/coevaluadores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("Respuesta coevaluador:", respuesta);

            // ✅ VERIFICAR si respuesta es array y tomar el primer elemento
            if (Array.isArray(respuesta) && respuesta.length > 0) {
                respuesta = respuesta[0];
            }

            // ✅ Llenar todos los campos del modal
            $("#EditIdCoevaluador").val(respuesta["ID_usuarios"]);
            $("#EditIdTipoDc").val(respuesta["tipo_dc"]);
            $("#EditIdNumero").val(respuesta["numero"]);
            $("#EditIdNombres").val(respuesta["nombres"]);
            $("#EditIdApellidos").val(respuesta["apellidos"]);
            $("#EditIdEmail").val(respuesta["email"]);
            $("#EditIdEmailInsti").val(respuesta["email_insti"]);
            $("#EditIdDireccion").val(respuesta["direccion"]);
            $("#EditIdContacto1").val(respuesta["contacto1"]);
            $("#EditIdContacto2").val(respuesta["contacto2"]);
            
            // ✅ IMPORTANTE: Limpiar el campo de contraseña (no mostrar la contraseña actual)
            $("#EditIdClave").val("");
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            console.error("Respuesta del servidor:", xhr.responseText);
            
            // ✅ Mostrar mensaje de error al usuario
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los datos del coevaluador'
            });
        }
    });
});

// ==============================
// Evento para ACTIVAR/INACTIVAR Coevaluador
// ==============================
$(document).on('click', '.btnActivarUsuario', function () {
    let idUsuarioActivar = $(this).attr("idUsuarioCambiarEstado");
    let nuevoEstado = $(this).attr("nuevoEstadoUsuario"); 
    let datos = new FormData();
    datos.append("id_cambiarEstado", idUsuarioActivar);
    datos.append("estadoCoevaluador", nuevoEstado);

    $.ajax({
        url: "ajax/coevaluadores.ajax.php",
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
                    $(`button[idUsuarioCambiarEstado="${idUsuarioActivar}"]`)
                        .removeClass("btn-success")
                        .addClass("btn-danger")
                        .html("Inactivo")
                        .attr("nuevoEstadoUsuario", "Activo");
                } else {
                    $(`button[idUsuarioCambiarEstado="${idUsuarioActivar}"]`)
                        .removeClass("btn-danger")
                        .addClass("btn-success")
                        .html("Activo")
                        .attr("nuevoEstadoUsuario", "Inactivo");
                }
            } else {
                console.error("Error al cambiar estado:", respuesta);
                alert("Error al cambiar el estado del coevaluador");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            alert("Error de conexión al cambiar estado");
        }
    });
});