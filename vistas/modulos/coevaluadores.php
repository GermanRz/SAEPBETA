<div class="content-wrapper">

  <!-- Encabezado -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1>Coevaluadores Registrados</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Coevaluadores</li>
          </ol>
        </div>

        <div class="col-sm-12">
          <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAgregarCoevaluador">
            Agregar Coevaluador
          </button>
        </div>

      </div>
    </div>
  </section>

  <!-- Contenido principal -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped dt-responsive nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tipo Doc</th>
                  <th>Número</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Email</th>
                  <th>Email Inst.</th>
                  <th>Dirección</th>
                  <th>Contacto 1</th>
                  <th>Contacto 2</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $coevaluadores = ControladorCoevaluadores::ctrMostrarCoevaluadores();

                if (!empty($coevaluadores)) {
                  foreach ($coevaluadores as $value) {
                    echo '<tr>';
                    echo '<td>' . $value["ID_usuarios"] . '</td>';
                    echo '<td>' . $value["tipo_dc"] . '</td>';
                    echo '<td>' . $value["numero"] . '</td>';
                    echo '<td>' . $value["nombres"] . '</td>';
                    echo '<td>' . $value["apellidos"] . '</td>';
                    echo '<td>' . $value["email"] . '</td>';
                    echo '<td>' . ($value["email_insti"] ?? 'No aplica') . '</td>';
                    echo '<td>' . $value["direccion"] . '</td>';
                    echo '<td>' . $value["contacto1"] . '</td>';
                    echo '<td>' . $value["contacto2"] . '</td>';
                    echo '<td>' . $value["rol"] . '</td>';

                    // Botón estado
                    if ($value["estado"] == "Activo") {
                      echo '<td><button class="btn btn-success btn-sm btnActivarUsuario" idUsuarioCambiarEstado="' . $value["ID_usuarios"] . '" nuevoEstadoUsuario="Inactivo">Activo</button></td>';
                    } else {
                      echo '<td><button class="btn btn-danger btn-sm btnActivarUsuario" idUsuarioCambiarEstado="' . $value["ID_usuarios"] . '" nuevoEstadoUsuario="Activo">Inactivo</button></td>';
                    }

                    // Botón editar
                    echo '<td><button class="btn btn-xs btn-primary btnEditarCoevaluador" idUsuario="' . $value["ID_usuarios"] . '" data-toggle="modal" data-target="#modalEditarCoevaluador"><i class="fas fa-pencil-alt"></i></button></td>';
                    echo '</tr>';
                  }
                } else {
                  echo '<tr><td colspan="13">No se encontraron coevaluadores registrados.</td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </section>

</div>

<!-- Modal Agregar Coevaluador - MEJORADO -->
<div class="modal fade" id="modalAgregarCoevaluador">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Agregar Coevaluador</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Documento</label>
                                <select class="form-control" name="tipoDc" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                    <option value="Cedula Extranjeria">Cédula Extranjería</option>
                                    <option value="PEP">PEP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número de Identificación</label>
                                <input type="text" class="form-control" name="numero" placeholder="Número de Identificación" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" name="nombres" placeholder="Nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correo Electrónico Personal</label>
                                <input type="email" class="form-control" name="email" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correo Electrónico Institucional</label>
                                <input type="email" class="form-control" name="emailInsti" placeholder="correo@institucion.edu.co" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Dirección completa" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número Telefónico Principal</label>
                                <input type="text" class="form-control" name="contacto1" placeholder="3001234567" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número Telefónico Secundario</label>
                                <input type="text" class="form-control" name="contacto2" placeholder="3001234567" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="clave" placeholder="Mínimo 6 caracteres" required minlength="6">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php
                $crearCoevaluador = new ControladorCoevaluadores();
                $crearCoevaluador->ctrCrearCoevaluadores();
                ?>
            </form>

        </div>
    </div>
</div>

<!-- Modal Editar Coevaluador - MEJORADO -->
<div class="modal fade" id="modalEditarCoevaluador">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar Coevaluador</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" id="EditIdCoevaluador" name="EditIdCoevaluador" required>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Documento</label>
                                <select class="form-control" id="EditIdTipoDc" name="EditIdTipoDc" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                    <option value="Cedula Extranjeria">Cedula Extranjería</option>
                                    <option value="PEP">PEP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número de Identificación</label>
                                <input type="text" class="form-control" id="EditIdNumero" name="EditIdNumero" placeholder="Número de Identificación" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" id="EditIdNombres" name="EditIdNombres" placeholder="Nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" id="EditIdApellidos" name="EditIdApellidos" placeholder="Apellidos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correo Electrónico Personal</label>
                                <input type="email" class="form-control" id="EditIdEmail" name="EditIdEmail" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correo Electrónico Institucional</label>
                                <input type="email" class="form-control" id="EditIdEmailInsti" name="EditIdEmailInsti" placeholder="correo@institucion.edu.co" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" id="EditIdDireccion" name="EditIdDireccion" placeholder="Dirección completa" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número Telefónico Principal</label>
                                <input type="text" class="form-control" id="EditIdContacto1" name="EditIdContacto1" placeholder="3001234567" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número Telefónico Secundario</label>
                                <input type="text" class="form-control" id="EditIdContacto2" name="EditIdContacto2" placeholder="3001234567" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" id="EditIdClave" name="EditIdClave" placeholder="Dejar vacío para mantener contraseña actual" minlength="6">
                        <small class="form-text text-muted">Dejar vacío si no desea cambiar la contraseña</small>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

                <?php
                $editarCoevaluador = new ControladorCoevaluadores();
                $editarCoevaluador->ctrEditarCoevaluador();
                ?>
            </form>

        </div>
    </div>
</div>


