<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="margin-left: 30px;">Coevaluadores Registrados</h1>
                </div>
                <div class="col-sm-12">
                    <div class="float-right" style="display: flex; align-items: center; gap: 10px; margin-right: 20px; margin-top: -40px;">
                        <!-- Buscador -->
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tablaCoevaluadores" class="table table-bordered table-striped">
                                    <thead> 
                                        <tr style="background-color: #39A900; color: white;">
                                            <th>Tipo de Documento</th>
                                            <th>Número</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>CC</td>
                                        <td>3010000003</td>
                                        <td>Luis</td>
                                        <td>Rodríguez</td>
                                        <td>luis.rodriguez@email.com</td>
                                
                                    </tr>
                                    <tr>
                                        <td>CC</td>
                                        <td>3010000009</td>
                                        <td>Diego</td>
                                        <td>Ruiz</td>
                                        <td>diego.ruiz@email.com</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>CC</td>
                                        <td>3010000015</td>
                                        <td>Miguel</td>
                                        <td>Santos</td>
                                        <td>miguel.santos@email.com</td>
                                
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
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