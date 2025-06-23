<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aprendices Registrados</h1>
                </div>

                <div class="col-sm-12">
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAgregarPrograma"> Agregar Programa</button>
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de documeto</th>
                                    <th>numero</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Email institucional</th>
                                    <th>Direccion</th>
                                    <th>Contacto</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "../../controladores/verUsuarios.controlador.php";
                                require_once "../../modelos/verUsuarios.modelo.php";

                                #$valor = null;
                                $usuarios = ControladorVerUsuarios::ctrMostrarUsuarios();
                                // var_dump($programas);
                                foreach ($usuarios as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $value["ID_usuarios"] . '</td>';
                                    echo '<td>' . $value["tipo_dc"] . '</td>';
                                    echo '<td>' . $value["numero"] . '</td>';
                                    echo '<td>' . $value["nombres"] . '</td>';
                                    echo '<td>' . $value["email"] . '</td>';
                                    echo '<td>' . $value["direccion"] . '</td>';
                                    echo '<td>' . $value["contacto1"] . '</td>';
                                    echo '<td>' . $value["estado"] . '</td>';
                                    echo '<td>' . $value["ID_rol"] . '</td>';
                                    if ($value["estado"] == "Activo") {
                                        echo  '<td><button class="btn btn-success btn-sm">Activo</button></td>';
                                    } else {
                                        echo  '<td><button class="btn btn-danger btn-sm">Inactivo</button></td>';
                                    }
                                    echo '<td><button class="btn btn-xs btn-primary btnEditarPrograma" idprograma="' . $value["ID_programas"] . '" data-toggle="modal" data-target="#modalEditarPrograma"><i class="fas fa-pencil-alt"></i></button></td>';
                                    echo '</tr>';
                                };

                                ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<!-- ==========
 modal agregar programa
 =============== -->

<div class="modal fade" id="modalAgregarPrograma">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar programa de formación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <label for="descripcionPrograma">Descripción</label>
                    <input type="text" class="form-control" name="descripcionPrograma" required>
                    <label for="versionPrograma" class="mt-2">Versión</label>
                    <input type="text" class="form-control" name="versionPrograma" required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                <?php

                $crearPrograma = new ControladorProgramas();
                $crearPrograma->ctrCrearPrograma();


                ?>



            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- ==========
 modal editar programa
 =============== -->

<div class="modal fade" id="modalEditarPrograma">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar programa de formación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="editIdPrograma" name="editIdPrograma" required>

                    <label for="descripcionPrograma">Descripción</label>
                    <input type="text" class="form-control" id="editDescripcionPrograma" name="editDescripcionPrograma" required>
                    <label for="descripcionPrograma">Versión</label>
                    <input type="text" class="form-control" id="editVersionPrograma" name="editVersionPrograma" required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                <?php
                    $editarPrograma = new ControladorProgramas();
                    $editarPrograma->ctrEditarprograma();

                ?>


            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>