function mostrarDetalles(btn) {
    var tr = $(btn).closest('tr');
    $('#modalNit').text(tr.data('nit'));
    $('#modalNombre').text(tr.data('nombre'));
    $('#modalDireccion').text(tr.data('direccion'));
    $('#modalArea').text(tr.data('area'));
    $('#modalTelefono').text(tr.data('contacto'));
    $('#modalEmail').text(tr.data('email'));
    $('#modalDepartamento').text(tr.data('departamento'));
    $('#modalCiudad').text(tr.data('ciudad'));
    $('#modalCoevaluador').text(tr.data('coevaluador'));
    $('#modalEstado').text(tr.data('estado'));
    $('#detalleModal').modal('show');
}

function mostrarActualizar(btn) {
    const tr = $(btn).closest('tr');
    const departamentoSeleccionado = tr.data('departamento');
    const ciudadSeleccionada = tr.data('ciudad');
  // 🔑 Aquí ponemos el id de la empresa, NO el del usuario


    $('#updateID').val(tr.data('idempresa')); 
    $('#updateNit').val(tr.data('nit'));
    $('#updateNombre').val(tr.data('nombre'));
    $('#updateDireccion').val(tr.data('direccion'));
    $('#updateArea').val(tr.data('area'));
    $('#updateTelefono').val(tr.data('contacto'));
    $('#updateEmail').val(tr.data('email'));
    $('#updateEstado').val(tr.data('estado'));
    $('#updateCoevaluador').val(tr.data('idusuario'));

    fetch("/SAEPBETA/vistas/recursos/departamentos_ciudades.json")
        .then(response => response.json())
        .then(data => {
            const departamentoSelect = document.getElementById("updateDepartamento");
            departamentoSelect.innerHTML = '<option value="">Seleccione un departamento</option>';

            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.departamento;
                option.textContent = item.departamento;
                if (item.departamento === departamentoSeleccionado) {
                    option.selected = true;
                }
                departamentoSelect.appendChild(option);
            });

            const ciudadSelect = document.getElementById("updateCiudad");
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            const departamentoObj = data.find(item => item.departamento === departamentoSeleccionado);
            if (departamentoObj) {
                departamentoObj.ciudades.forEach(ciudad => {
                    const option = document.createElement("option");
                    option.value = ciudad;
                    option.textContent = ciudad;
                    if (ciudad === ciudadSeleccionada) {
                        option.selected = true;
                    }
                    ciudadSelect.appendChild(option);
                });
            }
        });

    $('#actualizarModal').modal('show');
}
