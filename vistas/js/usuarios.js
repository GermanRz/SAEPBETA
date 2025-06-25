$(document).on('click', '.btnActivarUsuario', function () {
    let boton = $(this);
    let idUsuario = boton.attr("idUsuarioCambiarEstado");
    let nuevoEstado = boton.attr("nuevoEstadoUsuario");

    let datos = new FormData();
    datos.append("id_cambiarEstadoUsuario", idUsuario);
    datos.append("estadoUsuario", nuevoEstado);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.trim() === "ok") {
                // Cambiar botón visualmente
                if (nuevoEstado === "Inactivo") {
                    boton.removeClass("btn-success")
                         .addClass("btn-danger")
                         .html("Inactivo")
                         .attr("nuevoEstadoUsuario", "Activo");
                    toastr.success("Usuario desactivado correctamente");
                } else {
                    boton.removeClass("btn-danger")
                         .addClass("btn-success")
                         .html("Activo")
                         .attr("nuevoEstadoUsuario", "Inactivo");
                    toastr.success("Usuario activado correctamente");
                }
            } else {
                toastr.error("Error al actualizar el estado");
            }
        },
        error: function () {
            toastr.error("Error de conexión con el servidor");
        }
    });
});

toastr.options = {
  "closeButton": true,
  "positionClass": "toast-top-right",
  "timeOut": "2000"
};

