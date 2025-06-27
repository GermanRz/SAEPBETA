<?php
// Verificar que el usuario esté logueado
if(!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] != "ok"){
    echo '<script>window.location = "login";</script>';
    return;
}

// Obtener datos del usuario actual
$usuario = ControladorUsuarios::ctrCrearUsuario();

if(!$usuario){
    echo '<script>window.location = "login";</script>';
    return;
}
?>

<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid" style="padding-top: 30px; padding-bottom: 100px;">
        <h2 class="text-center mb-4">Editar Perfil</h2>

        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario de Edición</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" id="btnEditar">
                    <i class="fas fa-edit"></i> Editar
                  </button>
                </div>
              </div>

              <form action="" method="post">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="nombres" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nombres" name="nombres" 
                             placeholder="Ingrese sus nombres" 
                             value="<?php echo htmlspecialchars($usuario['nombres']); ?>" required disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="apellidos" class="col-sm-3 col-form-label">Apellidos</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="apellidos" name="apellidos" 
                             placeholder="Ingrese sus apellidos" 
                             value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="tipoDocumento" class="col-sm-3 col-form-label">Tipo de Documento</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="tipoDocumento" name="tipoDocumento" required disabled>
                        <option value="">Seleccione una opción</option>
                        <option value="Cédula de Ciudadanía" <?php echo ($usuario['tipo_dc'] == 'Cédula de Ciudadanía') ? 'selected' : ''; ?>>Cédula de Ciudadanía</option>
                        <option value="Tarjeta de Identidad" <?php echo ($usuario['tipo_dc'] == 'Tarjeta de Identidad') ? 'selected' : ''; ?>>Tarjeta de Identidad</option>
                        <option value="Cédula de Extranjería" <?php echo ($usuario['tipo_dc'] == 'Cédula de Extranjería') ? 'selected' : ''; ?>>Cédula de Extranjería</option>
                        <option value="PEP" <?php echo ($usuario['tipo_dc'] == 'PEP') ? 'selected' : ''; ?>>PEP</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="identificacion" class="col-sm-3 col-form-label">Identificación</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="identificacion" name="identificacion" 
                             placeholder="Ingrese su número de identificación" 
                             value="<?php echo htmlspecialchars($usuario['numero']); ?>" required disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Correo</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" 
                             placeholder="Ingrese su correo electrónico" 
                             value="<?php echo htmlspecialchars($usuario['email']); ?>" required disabled>
                    </div>
                  </div>

                 <div class="form-group row">
                    <label for="emailInstitucional" class="col-sm-3 col-form-label">Correo Institucional</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="emailInstitucional" name="emailInstitucional" 
                             placeholder="Ingrese su correo institucional" 
                             value="<?php echo htmlspecialchars($usuario['email_insti']); ?>" required disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="direccion" name="direccion" 
                             placeholder="Ingrese su dirección" 
                             value="<?php echo htmlspecialchars($usuario['direccion']); ?>" disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="contacto" class="col-sm-3 col-form-label">Contacto</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contacto" name="contacto" 
                             placeholder="Ingrese su número de contacto" 
                             value="<?php echo htmlspecialchars($usuario['contacto1']); ?>" disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="rol" class="col-sm-3 col-form-label">Rol</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="rol" name="rol" required disabled>
                        <option value="">Seleccione un rol</option>
                        <option value="1" <?php echo ($usuario['ID_rol'] == 1) ? 'selected' : ''; ?>>Aprendiz</option>
                        <option value="2" <?php echo ($usuario['ID_rol'] == 2) ? 'selected' : ''; ?>>Evaluador</option>
                        <option value="3" <?php echo ($usuario['ID_rol'] == 3) ? 'selected' : ''; ?>>Coevaluador</option>
                        <option value="4" <?php echo ($usuario['ID_rol'] == 4) ? 'selected' : ''; ?>>Auxiliar</option>
                        <option value="5" <?php echo ($usuario['ID_rol'] == 5) ? 'selected' : ''; ?>>Funcionario</option>
                        <option value="6" <?php echo ($usuario['ID_rol'] == 6) ? 'selected' : ''; ?>>Administrador</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="estado" name="estado" required disabled>
                        <option value="">Seleccione estado</option>
                        <option value="Activo" <?php echo ($usuario['estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?php echo ($usuario['estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary" name="editarUsuario" id="btnGuardar" disabled>
                    <i class="fas fa-save"></i> Guardar cambios
                  </button>
                </div>

                <?php
                  $editarUsuario = new ControladorUsuarios();
                  $editarUsuario -> ctrEditarUsuario();
                ?>

              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<style>
  .card-header.bg-primary {
    background-color: #39A900 !important;
  }

  .btn.btn-primary {
    background-color: #39A900 !important;
    border-color: #2d7f00 !important;
  }

  .btn.btn-primary:hover {
    background-color: #2d7f00 !important;
    border-color: #256700 !important;
  }

  .btn.btn-info {
    background-color: #17a2b8 !important;
    border-color: #138496 !important;
  }

  .btn.btn-info:hover {
    background-color: #138496 !important;
    border-color: #117a8b !important;
  }

  /* Botón Editar - Verde claro */
  .btn.btn-success {
    background-color: #4CAF50 !important;
    border-color: #45a049 !important;
    color: white !important;
  }

  .btn.btn-success:hover {
    background-color: #45a049 !important;
    border-color: #3d8b40 !important;
  }

  /* Botón Cancelar - Rojo claro */
  .btn.btn-danger {
    background-color: #ff6b6b !important;
    border-color: #ff5252 !important;
    color: white !important;
  }

  .btn.btn-danger:hover {
    background-color: #ff5252 !important;
    border-color: #ff4444 !important;
  }

  /* Estilos para campos deshabilitados */
  .form-control:disabled {
    background-color: #f8f9fa !important;
    opacity: 0.8;
  }

  .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }

  /* Estilos para el header con el botón a la derecha */
  .header-flex {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 0.75rem 1.25rem !important;
  }

  .header-flex .card-title {
    margin: 0 !important;
    font-size: 1.25rem !important;
  }

  .header-flex .btn {
    margin-left: auto !important;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnEditar = document.getElementById('btnEditar');
    const btnGuardar = document.getElementById('btnGuardar');
    
    // Todos los inputs y selects del formulario
    const campos = document.querySelectorAll('#nombres, #apellidos, #tipoDocumento, #identificacion, #email, #emailInstitucional, #direccion, #contacto, #rol, #estado');
    
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
</script>