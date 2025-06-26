document.addEventListener('DOMContentLoaded', function() {
    const btnEditar = document.getElementById('btnEditar');
    const btnGuardar = document.getElementById('btnGuardar');
    
    // Todos los inputs y selects del formulario (incluyendo los campos de aprendiz)
    const campos = document.querySelectorAll('#nombres, #apellidos, #tipoDocumento, #identificacion, #email, #emailInstitucional, #direccion, #contacto, #rol, #estado, #estadoFormativo, #modalidad, #ficha, #empresa');
    
    let modoEdicion = false;
    
    btnEditar.addEventListener('click', function() {
        if (!modoEdicion) {
            // Habilitar modo edición
            campos.forEach(campo => {
                campo.disabled = false;
            });
            
            btnGuardar.disabled = false;
            btnEditar.innerHTML = '<i class="fas fa-times"></i> Cancelar';
            btnEditar.classList.remove('btn-success');
            btnEditar.classList.add('btn-danger');
            
            modoEdicion = true;
        } else {
            // Cancelar edición - recargar página para restaurar valores originales
            if (confirm('¿Está seguro de que desea cancelar los cambios?')) {
                location.reload();
            }
        }
    });
});