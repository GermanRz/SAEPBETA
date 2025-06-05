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
              </div>

              <form>
                <div class="card-body">

                  <div class="form-group row">
                    <label for="nombres" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nombres" placeholder="Ingrese sus nombres">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="apellidos" class="col-sm-3 col-form-label">Apellidos</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="apellidos" placeholder="Ingrese sus apellidos">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="tipoDocumento" class="col-sm-3 col-form-label">Tipo de Documento</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="tipoDocumento">
                        <option value="">Seleccione una opción</option>
                        <option value="cc">Cédula de Ciudadanía</option>
                        <option value="ti">Tarjeta de Identidad</option>
                        <option value="ce">Cédula de Extranjería</option>
                        <option value="passport">PEP</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="identificacion" class="col-sm-3 col-form-label">Identificación</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="identificacion" placeholder="Ingrese su número de identificación">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="direccion" placeholder="Ingrese su dirección">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="contacto" class="col-sm-3 col-form-label">Contacto</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contacto" placeholder="Ingrese su número de contacto">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="rol" class="col-sm-3 col-form-label">Rol</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="rol">
                        <option value="">Seleccione un rol</option>
                        <option value="usuario">Aprendiz</option>
                        <option value="usuario">Evaluador</option>
                        <option value="usuario">Coevaluador</option>
                        <option value="editor">Funcionario</option>
                        <option value="admin">Administrador</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="estado">
                        <option value="">Seleccione estado</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
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


</style>

