<div class="content-wrapper">

  <!-- Encabezado -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1>Auxiliares Registrados</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Auxiliares</li>
          </ol>
        </div>

        <div class="col-sm-12">
          <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAgregarAuxiliar">
            Agregar Auxiliar
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
                $auxiliares = ControladorAuxiliares::ctrMostrarAuxiliares();

                if (!empty($auxiliares)) {
                  foreach ($auxiliares as $value) {
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
                    echo '<td><button class="btn btn-xs btn-primary btnEditarAuxiliar" idUsuario="' . $value["ID_usuarios"] . '" data-toggle="modal" data-target="#modalEditarAuxiliar"><i class="fas fa-pencil-alt"></i></button></td>';
                    echo '</tr>';
                  }
                } else {
                  echo '<tr><td colspan="13">No se encontraron auxiliares registrados.</td></tr>';
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
