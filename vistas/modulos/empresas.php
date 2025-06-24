<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registrar Empresa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Registrar Empresa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Registro</h3>
                        </div>

                        <!-- FORMULARIO -->
                        <form method="POST" autocomplete="off">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nit">NIT</label>
                                            <input type="text" class="form-control" name="nit" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre</label>
                                            <input type="text" class="form-control" name="nombre_empresa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="area">Área</label>
                                            <input type="text" class="form-control" name="area" required>
                                        </div>
                                        <!-- Campo de Coevaluador -->
                                        <div class="form-group">
                                            <label for="coevaluador">Coevaluador</label>
                                            <select class="form-control" name="coevaluador" required>
                                                <option value="">Seleccione un coevaluador</option>
                                                <?php
                                                $conn = new mysqli("localhost", "root", "", "saep");
                                                if ($conn->connect_error) {
                                                    die("Conexión fallida: " . $conn->connect_error);
                                                }
                                                $sql = "SELECT ID_usuarios, nombres, apellidos FROM usuarios WHERE ID_rol = 3 AND estado = 'Activo'";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="'.$row['ID_usuarios'].'">'.$row['nombres'].' '.$row['apellidos'].'</option>';
                                                }
                                                $conn->close();
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contacto">Contacto</label>
                                            <input type="text" class="form-control" name="contacto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="departamento">Departamento</label>
                                            <input type="text" class="form-control" name="departamento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" class="form-control" name="ciudad" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" name="estado" required>
                                                <option value="Activo">Activo</option>
                                                <option value="Inactivo">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón con name CORRECTO -->
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary" name="registrarEmpresa">Registrar Empresa</button>
                            </div>

                            <!-- Lógica del Controlador -->
                            <?php
                            require_once $_SERVER["DOCUMENT_ROOT"].'/SAEPBETA/controladores/empresas.controlador.php';
                            $crearEmpresa = new ControladorEmpresas();
                            $crearEmpresa->ctrCrearEmpresa();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
