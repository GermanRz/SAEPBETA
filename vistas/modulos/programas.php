<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Programas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Programas</li>
                    </ol>
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
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>001</td>
                                    <td>Análisis y Desarrollo de Software</td>
                                    <td><button class="btn btn-success btn -sm">Activo</button></td>
                                    <!-- <td>Activo</td> -->
                                    <td><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalEditarPrograma"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>Gestión Administrativa</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>003</td>
                                    <td>Contabilidad y Finanzas</td>
                                    <td><button class="btn btn-danger btn -sm">Inactivo</button></td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>004</td>
                                    <td>Gestión del Talento Humano</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>005</td>
                                    <td>Diseño e Integración de Multimedia</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>006</td>
                                    <td>Desarrollo de Videojuegos</td>
                                    <td>Inactivo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>007</td>
                                    <td>Producción Multimedia</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>008</td>
                                    <td>Mecánica Industrial</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>009</td>
                                    <td>Gestión de Redes de Datos</td>
                                    <td>Inactivo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <tr>
                                    <td>010</td>
                                    <td>Instalaciones Eléctricas</td>
                                    <td>Activo</td>
                                    <td><button class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></td>
                                </tr>
                                <!-- 
                                <?php for ($i = 1; $i <= 50; $i++): ?>
                                    <tr>
                                        <td><?php echo "SENA-" . str_pad($i, 3, "0", STR_PAD_LEFT); ?></td>
                                        <td><?php echo "Programa de Formación " . $i; ?></td>
                                        <td><?php echo ($i % 2 == 0) ? "Activo" : "Inactivo"; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endfor; ?> -->



                            </tbody>
                        </table>
                    </div>






                </div>
            </div>
        </div>
    </section>

</div>



<!-- =====================================================================

MODAL AGREGAR Programa

====================================================================== -->

<div class="modal fade" id="modalAgregarPrograma">
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
                    <label for = "descripcionprograma">Descripción</label>
                    <input type="text" class="form-control" name="descripcionPrograma"required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      

<!-- =====================================================================

MODAL EDITAR Programa

====================================================================== -->

<div class="modal fade" id="modalEditarPrograma">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar programa de formación</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="" method="POST">
                <div class="modal-body">
                    <label for = "descripcionprograma">Descripción</label>
                    <input type="text" class="form-control" name="descripcionPrograma"required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->