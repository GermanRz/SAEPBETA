<!-- Centrado para el login -->
<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f4f6f9;
  }
</style>

<div class="login-box">
  <div class="login-logo">
    <a href=""><b>SAEP</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body "> 
      <p class="login-box-msg">Iniciar Sesión</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo electrónico" name="ingEmail">

    
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
    
         </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>

        <?php
            $login = new ControladorUsuarios();
            $login->ctrIngresoUsuario();
        ?>


      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
