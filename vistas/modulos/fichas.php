<?php
// Asegúrate de incluir los controladores necesarios al inicio del archivo
require_once "controladores/fichas.controlador.php";
require_once "controladores/programas.controlador.php"; // Agregar este
require_once "controladores/sedes.controlador.php";     // Agregar este
?>

<div class="content-wrapper">

    <!-- Encabezado -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Fichas</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Fichas</li>
                    </ol>
                </div>

                <div class="col-sm-12">
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAgregarFicha">
                        Agregar Ficha
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Programa</th>
                                    <th>Sede</th>
                                    <th>Modalidad</th>
                                    <th>Jornada</th>
                                    <th>Nivel Formación</th>
                                    <th>Tipo Oferta</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin Lectiva</th>
                                    <th>Fecha Final</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $valor = null;
                                $fichas = ControladorFichas::ctrMostrarFichas($valor);

                                foreach ($fichas as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $value["ID_Fichas"] . '</td>';
                                    echo '<td>' . $value["codigo"] . '</td>';
                                    echo '<td>' . $value["nombre_programa"] . '</td>';
                                    echo '<td>' . $value["nombre_sede"] . '</td>';
                                    echo '<td>' . $value["modalidad"] . '</td>';
                                    echo '<td>' . $value["jornada"] . '</td>';
                                    echo '<td>' . $value["nivel_formacion"] . '</td>';
                                    echo '<td>' . $value["tipo_oferta"] . '</td>';
                                    echo '<td>' . $value["fecha_inicio"] . '</td>';
                                    echo '<td>' . $value["fecha_fin_lec"] . '</td>';
                                    echo '<td>' . $value["fecha_final"] . '</td>';

                                    // Botón estado - CORREGIDO
                                    if ($value["estado"] == "Activo") { // Cambiado de "Activa" a "Activo"
                                        echo '<td><button class="btn btn-success btn-sm btnActivarFicha" idFichaCambiarEstado="' . $value["ID_Fichas"] . '" nuevoEstado="Inactivo">Activo</button></td>';
                                    } else {
                                        echo '<td><button class="btn btn-danger btn-sm btnActivarFicha" idFichaCambiarEstado="' . $value["ID_Fichas"] . '" nuevoEstado="Activo">Inactivo</button></td>';
                                    }
                                      
                                    // Botón editar
                                    echo '<td><button class="btn btn-xs btn-primary btnEditarFicha" idFicha="' . $value["ID_Fichas"] . '" data-toggle="modal" data-target="#modalEditarFicha"><i class="fas fa-pencil-alt"></i></button></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- ========== Modal Agregar Ficha ========== -->
<div class="modal fade" id="modalAgregarFicha">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Agregar Ficha de Formación</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">

                    <input type="text" class="form-control" name="codigoFicha" placeholder="Código de Ficha" required>

                    <select class="form-control mt-2" name="programaFicha" required>
                        <option value="">Seleccione un programa</option>
                        <?php
                        // Verifica si existe el controlador antes de usarlo
                        if (class_exists('ControladorProgramas')) {
                            $programas = ControladorProgramas::ctrMostrarProgramas(null);
                            foreach ($programas as $programa) {
                                echo '<option value="'.$programa["ID_programas"].'">'.$programa["nombre_programa"].'</option>';
                            }
                        }
                        ?>
                    </select>
                    
                    <select class="form-control mt-2" name="sedeFicha" required>
                        <option value="">Seleccione una sede</option>
                        <?php
                        // Verifica si existe el controlador antes de usarlo
                        if (class_exists('ControladorSedes')) {
                            $sedes = ControladorSedes::ctrMostrarSedes(null);
                            foreach ($sedes as $sede) {
                                echo '<option value="'.$sede["ID_sede"].'">'.$sede["nombre_sede"].'</option>';
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control mt-2" name="modalidadFicha" required>
                        <option value="">Seleccione modalidad</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>

                    <select class="form-control mt-2" name="jornadaFicha" required>
                        <option value="">Seleccione jornada</option>
                        <option value="Diurna">Diurna</option>
                        <option value="Mixta">Mixta</option>
                        <option value="Nocturna">Nocturna</option>
                    </select>

                    <select class="form-control mt-2" name="nivelFormacionFicha" required>
                        <option value="">Seleccione nivel de formación</option>
                        <option value="Técnico">Técnico</option>
                        <option value="Tecnólogo">Tecnólogo</option>
                    </select>

                    <select class="form-control mt-2" name="tipoOfertaFicha" required>
                        <option value="">Seleccione tipo de oferta</option>
                        <option value="Abierta">Abierta</option>
                        <option value="Cerrada">Cerrada</option>
                    </select>

                    <input type="date" class="form-control mt-2" name="fechaInicioFicha" placeholder="Fecha de Inicio" required>
                    <input type="date" class="form-control mt-2" name="fechaFinLecFicha" placeholder="Fecha Fin Lectiva" required>
                    <input type="date" class="form-control mt-2" name="fechaFinalFicha" placeholder="Fecha Final" required>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php
                $crearFicha = new ControladorFichas();
                $crearFicha->ctrCrearFicha();
                ?>
            </form>

        </div>
    </div>
</div>

<!-- ========== Modal Editar Ficha ========== -->
<div class="modal fade" id="modalEditarFicha">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar Ficha de Formación</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">

                    <input type="hidden" id="editIdFicha" name="editIdFicha" required>

                    <label for="editCodigoFicha">Código</label>
                    <input type="text" class="form-control" id="editCodigoFicha" name="editCodigoFicha" required>

                    <label class="mt-2" for="editProgramaFicha">Programa</label>
                    <select class="form-control" id="editProgramaFicha" name="editProgramaFicha" required>
                        <option value="">Seleccione un programa</option>
                        <?php
                        if (class_exists('ControladorProgramas')) {
                            $programas = ControladorProgramas::ctrMostrarProgramas(null);
                            foreach ($programas as $programa) {
                                echo '<option value="'.$programa["ID_programas"].'">'.$programa["nombre_programa"].'</option>';
                            }
                        }
                        ?>
                    </select>

                    <label class="mt-2" for="editSedeFicha">Sede</label>
                    <select class="form-control" id="editSedeFicha" name="editSedeFicha" required>
                        <option value="">Seleccione una sede</option>
                        <?php
                        if (class_exists('ControladorSedes')) {
                            $sedes = ControladorSedes::ctrMostrarSedes(null);
                            foreach ($sedes as $sede) {
                                echo '<option value="'.$sede["ID_sede"].'">'.$sede["nombre_sede"].'</option>';
                            }
                        }
                        ?>
                    </select>

                    <label class="mt-2" for="editModalidadFicha">Modalidad</label>
                    <select class="form-control" id="editModalidadFicha" name="editModalidadFicha" required>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>

                    <label class="mt-2" for="editJornadaFicha">Jornada</label>
                    <select class="form-control" id="editJornadaFicha" name="editJornadaFicha" required>
                        <option value="Diurna">Diurna</option>
                        <option value="Mixta">Mixta</option>
                        <option value="Nocturna">Nocturna</option>
                    </select>

                    <label class="mt-2" for="editNivelFormacionFicha">Nivel de Formación</label>
                    <select class="form-control" id="editNivelFormacionFicha" name="editNivelFormacionFicha" required>
                        <option value="Técnico">Técnico</option>
                        <option value="Tecnólogo">Tecnólogo</option>
                    </select>

                    <label class="mt-2" for="editTipoOfertaFicha">Tipo de Oferta</label>
                    <select class="form-control" id="editTipoOfertaFicha" name="editTipoOfertaFicha" required>
                        <option value="Abierta">Abierta</option>
                        <option value="Cerrada">Cerrada</option>
                    </select>

                    <label class="mt-2" for="editFechaInicioFicha">Fecha Inicio</label>
                    <input type="date" class="form-control" id="editFechaInicioFicha" name="editFechaInicioFicha" required>

                    <label class="mt-2" for="editFechaFinLecFicha">Fecha Fin Lectiva</label>
                    <input type="date" class="form-control" id="editFechaFinLecFicha" name="editFechaFinLecFicha" required>

                    <label class="mt-2" for="editFechaFinalFicha">Fecha Final</label>
                    <input type="date" class="form-control" id="editFechaFinalFicha" name="editFechaFinalFicha" required>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

                <?php
                $editarFicha = new ControladorFichas();
                $editarFicha->ctrEditarFicha();
                ?>
            </form>

        </div>
    </div>
</div>