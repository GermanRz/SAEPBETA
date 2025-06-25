<?php
// Captura el tipo enviado por la URL
$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : null;

// Define el título dinámico según el tipo
$titulo = "Usuarios Registrados";
switch ($tipo) {
    case "1": $titulo = "Aprendices Registrados"; break;
    case "2": $titulo = "Evaluadores Registrados"; break;
    case "3": $titulo = "Coevaluadores Registrados"; break;
    case "4": $titulo = "Auxiliares Registrados"; break;
}

// Llama al controlador y obtiene los usuarios filtrados
require_once "controladores/verUsuarios.controlador.php";
require_once "modelos/verUsuarios.modelo.php";

$usuarios = ControladorVerUsuarios::ctrMostrarUsuariosPorTipo($tipo);
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $titulo; ?></h1>
                </div>
            </div>
        </div>
    </section>

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
                                    <th>Contacto</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $value): ?>
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
                                        <td><?php echo $value["nombre_rol"]; ?></td>
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
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
</div>
