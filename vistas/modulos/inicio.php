<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>INICIO</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inicio</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  
 <!-- Sección principal con el gráfico - Solo para aprendices -->
  <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'aprendiz'): ?>
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8 mx-auto">
                  <!-- Tarjeta con el gráfico Donut -->
                  <div class="card card-success">
                      <div class="card-header">
                          <h3 class="card-title">Progreso en la Formación</h3>
                      </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-7">
                                  <!-- Información del programa -->
                                  <div class="mb-3">
                                      <h4><?php echo isset($_SESSION['programa']) ? $_SESSION['programa'] : 'Programa no asignado'; ?></h4>
                                      <p class="text-muted">
                                          <i class="fas fa-map-marker-alt"></i> <?php echo isset($_SESSION['sede']) ? $_SESSION['sede'] : 'Sede no asignada'; ?> | 
                                          <i class="fas fa-graduation-cap"></i> <?php echo isset($_SESSION['modalidad']) ? $_SESSION['modalidad'] : 'Modalidad no asignada'; ?>
                                      </p>
                                  </div>
                                  
                                  <!-- Barra de progreso mejorada -->
                                  <div class="progress-group">
                                      <span class="progress-text">Avance de la formación</span>
                                      <span class="float-right">
                                          <b><?php echo isset($_SESSION['progreso']) ? $_SESSION['progreso'] : 0; ?></b>/100%
                                      </span>
                                      <div class="progress progress-sm">
                                          <div class="progress-bar bg-success progress-bar-striped active" 
                                               id="barraProgreso" 
                                               style="width: <?php echo isset($_SESSION['progreso']) ? $_SESSION['progreso'].'%' : '0%'; ?>">
                                          </div>
                                      </div>
                                      <small class="text-muted">
                                          <?php 
                                          $mensaje = "Estado: ";
                                          if(isset($_SESSION['progreso'])) {
                                              if($_SESSION['progreso'] == 0) {
                                                  $mensaje .= "Formación recién iniciada";
                                              } elseif($_SESSION['progreso'] < 30) {
                                                  $mensaje .= "Etapa inicial";
                                              } elseif($_SESSION['progreso'] < 70) {
                                                  $mensaje .= "Etapa intermedia";
                                              } elseif($_SESSION['progreso'] < 100) {
                                                  $mensaje .= "Etapa final";
                                              } else {
                                                  $mensaje = "¡Formación completada!";
                                              }
                                          }
                                          echo $mensaje;
                                          ?>
                                      </small>
                                  </div>
                                  
                                  <!-- Información de fechas -->
                                  <div class="mt-4">
                                      <div class="row">
                                          <div class="col-sm-6">
                                              <strong>Fecha Inicio:</strong><br>
                                              <?php echo isset($_SESSION['fecha_inicio']) ? $_SESSION['fecha_inicio'] : date('d/m/Y'); ?>
                                          </div>
                                          <div class="col-sm-6">
                                              <strong>Fecha Final:</strong><br>
                                              <?php echo isset($_SESSION['fecha_fin']) ? $_SESSION['fecha_fin'] : date('d/m/Y', strtotime('+6 months')); ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <!-- Gráfico donut -->
                                  <canvas id="donutChart" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
                                  <div class="text-center mt-2">
                                      <small class="text-muted">Progreso global</small>
                                  </div>
                                  
                                  <!-- Sección de botones -->
                                  <div class="mt-3 d-flex flex-column">
                                       <button class="btn btn-success btn-block mb-2">
                                          🗒️Ver informacion
                                      </button>
                                      <button class="btn btn-primary btn-block mb-2">
                                          📕Ver Bitacoras
                                      </button>
                                      <button class="btn btn-info btn-block mb-2">
                                          📊Ver Seguimiento
                                      </button>
                                      <button class="btn btn-warning btn-block mb-2">
                                          💬Ver Novedades
                                      </button>
                                  </div>
                                 
                                  <!-- Novedades recientes -->
                                  <?php if(isset($_SESSION['novedades']) && !empty($_SESSION['novedades'])): ?>
                                  <div class="mt-3">
                                      <h5>Últimas novedades:</h5>
                                      <ul class="list-unstyled">
                                          <?php foreach($_SESSION['novedades'] as $novedad): ?>
                                          <li class="mb-2">
                                              <small><?php echo date('d/m/Y', strtotime($novedad['fecha'])); ?></small><br>
                                              <?php echo substr($novedad['novedad'], 0, 30); ?>...
                                          </li>
                                          <?php endforeach; ?>
                                      </ul>
                                  </div>
                                  <?php endif; ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <?php endif; ?>
</div>
<script src="vistas/js/inicioaprendiz.js"></script>
