<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAEP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini login-page">
  <!-- Site wrapper -->

  <?php

  if (isset($_SESSION["iniciarSesion"])  &&  $_SESSION["iniciarSesion"] == "ok") {

    echo '<script>
      document.addEventListener("DOMContentLoaded", function(){
        document.body.classList.remove("login-page");
      });    
    </script>';

    echo '<div class="wrapper">';

    include "modulos/cabezote.php";
    include "modulos/menu.php";

    if (isset($_GET["ruta"])) {
      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "programas" ||
        $_GET["ruta"] == "asignarinstructor" ||
        $_GET["ruta"] == "empresas" ||
        $_GET["ruta"] == "fichas" ||
        $_GET["ruta"] == "modalidades" ||
        $_GET["ruta"] == "modulos" ||
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "permisos" ||
        $_GET["ruta"] == "programas" ||
        $_GET["ruta"] == "roles" ||
        $_GET["ruta"] == "sedes" ||
        $_GET["ruta"] == "seguimiento" ||
        $_GET["ruta"] == "aprendices" ||
        $_GET["ruta"] == "auxiliares" ||
        $_GET["ruta"] == "evaluadores" ||
        $_GET["ruta"] == "coevaluadores" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "editarperfil" ||
        $_GET["ruta"] == "salir"
      ) {
        include "modulos/" . $_GET["ruta"] . ".php";
      } else {
        include "modulos/error404.php";
      }
    }
    include "modulos/footer.php";
    echo "</div>";
  } else {
    include "modulos/login.php";
  }

  ?>

  <!-- SCRIPTS - Cargados en el orden correcto -->

  <!-- jQuery PRIMERO -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables & Plugins -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/plugins/jszip/jszip.min.js"></script>
  <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="vistas/plugins/chart.js/Chart.min.js"></script>
  <script src="vistas/plugins/fontawesome/js/all.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- Scripts personalizados -->
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/programas.js"></script>
  <script src="vistas/js/modalidades.js"></script>
  <script src="vistas/js/fichas.js"></script>
  <script src="vistas/js/sedes.js"></script>
  <script src="vistas/js/coevaluador.js"></script>
  
  



  <!-- Script para asegurar que funcione el dropdown -->
  <script>
    $(document).ready(function() {
    // Solo inicializar si Bootstrap no está funcionando automáticamente
    if (typeof $().dropdown === 'undefined') {
        console.error('Bootstrap dropdown no está disponible');
    }
    
    // Remover el manejo manual que interfiere
    // $('.dropdown-toggle').dropdown(); // Bootstrap ya maneja esto automáticamente
    });
  </script>

  <?php
  if (
    isset($_SESSION["iniciarSesion"]) &&
    $_SESSION["iniciarSesion"] == "ok" &&
    isset($_GET["ruta"]) &&
    $_GET["ruta"] == "inicio" &&
    isset($_SESSION['rol']) &&
    $_SESSION['rol'] == "aprendiz"
  ): ?>
    <!-- JS solo para inicio y aprendices -->
    <script src="vistas/js/inicioaprendiz.js"></script>
  <?php endif; ?>


</body>

</html>