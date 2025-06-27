let selectedRow = null;

function selectRow(row) {
    if (selectedRow) selectedRow.classList.remove('selected');
    selectedRow = row;
    row.classList.add('selected');

    // Llenar los campos del modal de detalles (si usas modal de visualización)
    $('#modalIDUsuario').text(row.dataset.idusuario);
    $('#modalNit').text(row.dataset.nit);
    $('#modalNombre').text(row.dataset.nombre);
    $('#modalDireccion').text(row.dataset.direccion);
    $('#modalArea').text(row.dataset.area);
    $('#modalTelefono').text(row.dataset.contacto);
    $('#modalEmail').text(row.dataset.email);
    $('#modalDepartamento').text(row.dataset.departamento);
    $('#modalCiudad').text(row.dataset.ciudad);
    $('#modalCoevaluador').text(row.dataset.coevaluador);
    $('#modalEstado').text(row.dataset.estado);
}

$(document).ready(function () {
    $('#formActualizar').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'ajax/actualizar_empresa.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire('¡Actualizado!', 'La empresa fue modificada correctamente.', 'success')
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Error', res.error || 'No se pudo actualizar la empresa.', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Respuesta inesperada del servidor.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
            }
        });
    });
});


$(document).ready(function () {
    $('#btnActualizar').click(function () {
        if (!selectedRow) {
            alert('Seleccione una empresa');
            return;
        }

        // Precargar todos los valores en el modal
        $('#updateID').val(selectedRow.dataset.idempresa); // ID de la empresa
        $('#updateNit').val(selectedRow.dataset.nit);
        $('#updateNombre').val(selectedRow.dataset.nombre);
        $('#updateTelefono').val(selectedRow.dataset.contacto);
        $('#updateEmail').val(selectedRow.dataset.email);
        $('#updateDireccion').val(selectedRow.dataset.direccion);
       $('#departamento').val(selectedRow.dataset.departamento).trigger('change');

// Esperar un poco a que se carguen las ciudades
setTimeout(() => {
    $('#ciudad').val(selectedRow.dataset.ciudad);
}, 200);
        $('#updateArea').val(selectedRow.dataset.area);
        $('#updateCoevaluador').val(selectedRow.dataset.idusuario);
        $('#updateEstado').val(selectedRow.dataset.estado);

        $('#actualizarModal').modal('show');
    });

    $('#formActualizar').on('submit', function (e) {
        e.preventDefault();

        const datos = {
    id: $('#updateID').val(),
    nit: $('#updateNit').val(),
    nombre: $('#updateNombre').val(),
    direccion: $('#updateDireccion').val(),
    area: $('#updateArea').val(),
    coevaluador: $('#updateCoevaluador').val(),
    contacto: $('#updateTelefono').val(),
    email: $('#updateEmail').val(),
    departamento: $('#departamento').val(),  
    ciudad: $('#ciudad').val(),              
    estado: $('#updateEstado').val()
};

        $.post('ajax/empresas.ajax.php', {
            accion: 'editar',
            ...datos
        }, function (response) {
            if (response.trim() === 'ok') {
                const cells = selectedRow.getElementsByTagName('td');
                cells[1].textContent = datos.nombre;
                cells[2].textContent = datos.contacto;
                cells[3].textContent = $("#updateCoevaluador option:selected").text();
                cells[4].textContent = datos.estado;

                // Actualizar atributos del row seleccionado
                selectedRow.dataset.nit = datos.nit;
                selectedRow.dataset.nombre = datos.nombre;
                selectedRow.dataset.contacto = datos.contacto;
                selectedRow.dataset.email = datos.email;
                selectedRow.dataset.direccion = datos.direccion;
                selectedRow.dataset.departamento = datos.departamento;
                selectedRow.dataset.ciudad = datos.ciudad;
                selectedRow.dataset.area = datos.area;
                selectedRow.dataset.idusuario = datos.coevaluador;
                selectedRow.dataset.estado = datos.estado;

                $('#actualizarModal').modal('hide');

                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'La empresa fue editada correctamente',
                        confirmButtonText: 'Aceptar'
                    });
                }, 500);
            } else {
                Swal.fire("Error", "No se pudo actualizar: " + response, "error");
            }
        });
    });

    $('#actualizarModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });

    const firstRow = document.querySelector('tbody tr');
    if (firstRow) selectRow(firstRow);
});

function generarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text('Reporte de Empresas', 105, 15, { align: 'center' });

    const table = document.getElementById('empresaTable');
    const rows = table.querySelectorAll('tbody tr');
    const tableData = [];

    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        tableData.push([
            cells[0].textContent,
            cells[1].textContent,
            cells[2].textContent,
            cells[3].textContent,
            cells[4].textContent
        ]);
    });

    doc.autoTable({
        head: [['NIT', 'Nombre', 'Teléfono', 'Coevaluador', 'Estado']],
        body: tableData,
        startY: 25
    });

    doc.save('reporte_empresas.pdf');
}
