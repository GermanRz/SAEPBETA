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
                                            <select class="form-control" name="departamento" id="departamento" required>
                                                <option value="">Seleccione un departamento</option>
                                                <option value="Antioquia">Antioquia</option>
                                                <option value="Atlántico">Atlántico</option>
                                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Boyacá">Boyacá</option>
                                                <option value="Caldas">Caldas</option>
                                                <option value="Cauca">Cauca</option>
                                                <option value="Cesar">Cesar</option>
                                                <option value="Córdoba">Córdoba</option>
                                                <option value="Cundinamarca">Cundinamarca</option>
                                                <option value="Huila">Huila</option>
                                                <option value="La Guajira">La Guajira</option>
                                                <option value="Magdalena">Magdalena</option>
                                                <option value="Meta">Meta</option>
                                                <option value="Nariño">Nariño</option>
                                                <option value="Norte de Santander">Norte de Santander</option>
                                                <option value="Quindío">Quindío</option>
                                                <option value="Risaralda">Risaralda</option>
                                                <option value="Santander">Santander</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Tolima">Tolima</option>
                                                <option value="Valle del Cauca">Valle del Cauca</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <select class="form-control" name="ciudad" id="ciudad" required>
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                        </div>
                                        <script>
                                            const ciudadesPorDepartamento = {
                                                "Antioquia": ["Medellín", "Bello", "Itagüí", "Envigado", "Rionegro"],
                                                "Atlántico": ["Barranquilla", "Soledad", "Malambo", "Puerto Colombia"],
                                                "Bogotá D.C.": ["Bogotá"],
                                                "Bolívar": ["Cartagena", "Magangué", "Turbaco"],
                                                "Boyacá": ["Tunja", "Duitama", "Sogamoso"],
                                                "Caldas": ["Manizales", "Villamaría", "Chinchiná"],
                                                "Cauca": ["Popayán", "Santander de Quilichao"],
                                                "Cesar": ["Valledupar", "Aguachica"],
                                                "Córdoba": ["Montería", "Lorica"],
                                                "Cundinamarca": ["Soacha", "Girardot", "Zipaquirá"],
                                                "Huila": ["Neiva", "Pitalito"],
                                                "La Guajira": ["Riohacha", "Maicao"],
                                                "Magdalena": ["Santa Marta", "Ciénaga"],
                                                "Meta": ["Villavicencio", "Acacías"],
                                                "Nariño": ["Pasto", "Ipiales"],
                                                "Norte de Santander": ["Cúcuta", "Ocaña"],
                                                "Quindío": ["Armenia", "Calarcá"],
                                                "Risaralda": ["Pereira", "Dosquebradas"],
                                                "Santander": ["Bucaramanga", "Floridablanca", "Girón"],
                                                "Sucre": ["Sincelejo", "Corozal"],
                                                "Tolima": ["Ibagué", "Espinal"],
                                                "Valle del Cauca": ["Cali", "Palmira", "Buenaventura"]
                                            };

                                            document.getElementById('departamento').addEventListener('change', function() {
                                                const depto = this.value;
                                                const ciudadSelect = document.getElementById('ciudad');
                                                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                                if (ciudadesPorDepartamento[depto]) {
                                                    ciudadesPorDepartamento[depto].forEach(function(ciudad) {
                                                        const option = document.createElement('option');
                                                        option.value = ciudad;
                                                        option.text = ciudad;
                                                        ciudadSelect.appendChild(option);
                                                    });

                                                    // Preseleccionar ciudad si existe en atributo data-ciudad
                                                    const ciudadPreseleccionada = ciudadSelect.getAttribute('data-ciudad');
                                                    if (ciudadPreseleccionada) {
                                                        ciudadSelect.value = ciudadPreseleccionada;
                                                    }
                                                }
                                            });
                                        </script>
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
