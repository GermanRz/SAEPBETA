<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAEP</title>

  <!-- Google Font: Work Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">



  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">


  <!-- ====================================================================================== -->

  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- DataTables  & Plugins -->
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

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

</head>

<style>
  body {
    font-family: "Work Sans", sans-serif;
    font-optical-sizing: auto;
    font-weight: 400;
    /* Ajusta esto según el peso que desees */
    font-style: normal;
  }
</style>
<!-- Site wrapper -->

<body class="hold-transition sidebar-mini">


  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {


    echo 'div class="wrapper">';

    echo '<script>
      
        document.addEventListener("DOMContentLoaded", function() {
          document.body.classList.add("login-page");
        }
      
      </script>';

    include "vistas/modulos/cabezote.php";
    include "vistas/modulos/menu.php";

    if (isset($_GET["ruta"])) {
      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "programas" ||
        $_GET["ruta"] == "sedes" ||
        $_GET["ruta"] == "fichas" ||
        $_GET["ruta"] == "permisos" ||
        $_GET["ruta"] == "roles" ||
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "modulos" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "evaluadores" ||
        $_GET["ruta"] == "coevaluadores" ||
        $_GET["ruta"] == "aprendices" ||
        $_GET["ruta"] == "asignacion" ||
        $_GET["ruta"] == "empresa" ||
        $_GET["ruta"] == "auxiliares" ||
        $_GET["ruta"] == "salir" ||
        $_GET["ruta"] == "editarPerfil"
      ) {
        include "vistas/modulos/" . $_GET["ruta"] . ".php";
      } else {
        include "vistas/modulos/error404.php";
      }
    }

    include "vistas/modulos/footer.php";
    echo "</div>";
  } else {
    include "modulos/login.php";
  }


  ?>


  <script src="vistas/js/plantilla.js"></script>

</body>

</html>