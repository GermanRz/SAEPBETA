<div class="content-wrapper">

    <!-- Encabezado -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Evaluadores Registrados</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Evaluadores</li>
                    </ol>
                </div>

            </div>
        </div>
    </section>

    <!-- Contenido -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de documento</th>
                                    <th>Número</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Email institucional</th>
                                    <th>Dirección</th>
                                    <th>Contacto1</th>
                                    <th>Contacto2</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $evaluadores = ControladorEvaluadores ::ctrMostrarEvaluadores();

                                if (!empty($evaluadores)) {
                                    foreach ($evaluadores as $value): ?>
                                        <tr>
                                            <td><?php echo $value["ID_usuarios"]; ?></td>
                                            <td><?php echo $value["tipo_dc"]; ?></td>
                                            <td><?php echo $value["numero"]; ?></td>
                                            <td><?php echo $value["nombres"]; ?></td>
                                            <td><?php echo $value["apellidos"]; ?></td>
                                            <td><?php echo $value["email"]; ?></td>
                                            <td><?php echo $value["email_insti"] ?? 'No aplica'; ?></td>
                                            <td><?php echo $value["direccion"]; ?></td>
                                            <td><?php echo $value["contacto1"]; ?></td>
                                            <td><?php echo $value["contacto2"]; ?></td>
                                            <td><?php echo $value["rol"]; ?></td>
                                            <td>
                                                <?php if ($value["estado"] == "Activo"): ?>
                                                    <button class="btn btn-success btn-sm btnActivarUsuario"
                                                            idUsuarioCambiarEstado="<?php echo $value["ID_usuarios"]; ?>"
                                                            nuevoEstadoUsuario="Inactivo">
                                                        Activo
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-danger btn-sm btnActivarUsuario"
                                                            idUsuarioCambiarEstado="<?php echo $value["ID_usuarios"]; ?>"
                                                            nuevoEstadoUsuario="Activo">
                                                        Inactivo
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                } else {
                                    echo '<tr><td colspan="11">No se encontraron aprendices registrados.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

</div>
