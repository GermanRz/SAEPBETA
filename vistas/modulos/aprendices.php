<div class="content-wrapper">

  <!-- Encabezado -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1>Aprendices Registrados</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Aprendices</li>
          </ol>
        </div>

        <div class="col-sm-12">
          <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAgregarAprendiz">
            Agregar Aprendiz
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

          <div class="card-body ">
            <table id="example1" class="table table-bordered table-striped">
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
                $aprendices = ControladorAprendices::ctrMostrarAprendices();

                if (!empty($aprendices)) {
                  foreach ($aprendices as $value) {
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

                    // Botón editar (si necesitas agregarlo)
                    echo '<td><button class="btn btn-xs btn-primary btnEditarAprendiz" idUsuario="' . $value["ID_usuarios"] . '" data-toggle="modal" data-target="#modalEditarAprendiz"><i class="fas fa-pencil-alt"></i></button></td>';
                    echo '</tr>';
                  }
                } else {
                  echo '<tr><td colspan="13">No se encontraron aprendices registrados.</td></tr>';
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


<!-- Modal Agregar Aprendiz -->
<div class="modal fade" id="modalAgregarAprendiz">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Agregar Aprendiz</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">

                    <input type="text" name="nombre" class="form-control mt-2" placeholder="Nombre" required>
                    <input type="text" name="apellido" class="form-control mt-2" placeholder="Apellido" required>
                    <input type="text" name="documento" class="form-control mt-2" placeholder="Documento" required>
                    <input type="email" name="correo" class="form-control mt-2" placeholder="Correo" required>
                    <input type="text" name="usuario" class="form-control mt-2" placeholder="Usuario" required>
                    <input type="password" name="password" class="form-control mt-2" placeholder="Contraseña" required>

                    <input type="hidden" name="id_rol" value="1"> <!-- ID 1 = aprendiz -->

                    <select class="form-control mt-2" name="id_ficha" required>
                        <option value="">Seleccione una Ficha</option>
                        <?php
                        $fichas = ControladorFichas::ctrMostrarFichas(null);
                        foreach ($fichas as $ficha) {
                            echo '<option value="' . $ficha["id_fichas"] . '">' . $ficha["codigo"] . '</option>';
                        }
                        ?>
                    </select>

                    <select class="form-control mt-2" name="id_usuario" required>
                        <option value="">Seleccione un Evaluador</option>
                        <?php
                        $evaluadores = ControladorEvaluadores::ctrMostrarEvaluadores(2);
                        foreach ($evaluadores as $evaluador) {
                            echo '<option value="' . $evaluador["ID_usuarios"] . '">' . $evaluador["nombre"] . '</option>';
                        }
                        ?>
                    </select>

                    <select name="id_modalidad" class="form-control mt-2" required>
                        <option value="">Seleccione Modalidad</option>
                        <?php
                        $modalidades = ControladorModalidaes::ctrMostrarModalidades(null);
                        foreach ($modalidades as $modalidad) {
                            echo '<option value="' . $modalidad["id_moalidad"] . '">' . $modalidad["modalidad"] . '</option>';
                        }
                        ?>
                    </select>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

                <?php
                $crearAprendiz = new ControladorAprendices();
                $crearAprendiz->ctrCrearAprendiz();
                ?>

            </form>

        </div>
    </div>
</div>
