<body>
<div class="container mt-4">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Empresas</h3>
        <button class="btn btn-success" onclick="generarPDF()">Generar PDF</button>
    </div>
    <table class="table table-bordered" id="empresaTable">
        <thead class="thead-light">
            <tr>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Coevaluador</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php
require_once __DIR__ . "/../../modelos/conexion.php";
$conn = Conexion::conectar();

$sql = "SELECT 
            e.id_empresas,                       
            e.id_usuarios, 
            e.nit, 
            e.nombre, 
            e.contacto, 
            e.email, 
            e.direccion, 
            e.departamento, 
            e.ciudad, 
            e.area, 
            e.estado,
            CONCAT(u.nombres, ' ', u.apellidos) AS coevaluador
        FROM empresas e
        LEFT JOIN usuarios u ON e.id_usuarios = u.id_usuarios";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    foreach ($result as $row) {
        echo "<tr 
            data-idempresa='{$row['id_empresas']}'
            data-idusuario='{$row['id_usuarios']}'
            data-nit='{$row['nit']}'
            data-nombre='{$row['nombre']}'
            data-direccion='{$row['direccion']}'
            data-area='{$row['area']}'
            data-contacto='{$row['contacto']}'
            data-email='{$row['email']}'
            data-departamento='{$row['departamento']}'
            data-ciudad='{$row['ciudad']}'
            data-coevaluador='{$row['coevaluador']}'
            data-estado='{$row['estado']}'>
            <td>{$row['nit']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['contacto']}</td>
            <td>{$row['coevaluador']}</td>
            <td>{$row['estado']}</td>
            <td>
                <button class='btn btn-sm btn-info'   onclick='mostrarDetalles(this)'>🔍</button>
                <button class='btn btn-sm btn-warning' onclick='mostrarActualizar(this)'>✏️</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No hay empresas registradas.</td></tr>";
}
?>
</tbody>
    </table>
</div>


<!-- Modal Detalles -->
<div class="modal fade" id="detalleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Detalles de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           <div class="modal-body">
    <p><strong>NIT:</strong> <span id="modalNit"></span></p>
    <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
    <p><strong>Dirección:</strong> <span id="modalDireccion"></span></p>
    <p><strong>Área:</strong> <span id="modalArea"></span></p>
    <p><strong>Teléfono:</strong> <span id="modalTelefono"></span></p>
    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
    <p><strong>Departamento:</strong> <span id="modalDepartamento"></span></p>
    <p><strong>Ciudad:</strong> <span id="modalCiudad"></span></p>
    <p><strong>Coevaluador:</strong> <span id="modalCoevaluador"></span></p>
    <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
</div>
        </div>
    </div>
</div>

<!-- Modal Actualizar -->
<div class="modal fade" id="actualizarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Empresa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="" id="formActualizar"> 
                <input type="hidden" id="updateID" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="updateNit">NIT:</label>
                        <input type="text" class="form-control" id="updateNit" name="editNit">
                    </div>
                    <div class="form-group">
                        <label for="updateNombre">Nombre:</label>
                        <input type="text" class="form-control" id="updateNombre" name="editNombre" required>
                    </div>
                    <div class="form-group">
                        <label for="updateTelefono">Teléfono:</label>
                        <input type="text" class="form-control" id="updateTelefono" name="editContacto" required>
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email:</label>
                        <input type="email" class="form-control" id="updateEmail" name="editEmail">
                    </div>
                    <div class="form-group">
                        <label for="updateDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="updateDireccion" name="editDireccion">
                    </div>
                <div class="form-group">
    <label for="departamento">Departamento</label>
    <select class="form-control" id="updateDepartamento" name="departamento" required>
        <option value="">Seleccione un departamento</option>
    </select>
</div>

<div class="form-group">
    <label for="ciudad">Ciudad</label>
   <select class="form-control" id="updateCiudad" name="ciudad" required>
        <option value="">Seleccione una ciudad</option>
    </select>
</div>

                                            
                    <div class="form-group">
                        <label for="updateArea">Área:</label>
                        <input type="text" class="form-control" id="updateArea" name="editArea">
                    </div>

                    <div class="form-group">
                        <label for="updateCoevaluador">Coevaluador:</label>
                        <select class="form-control" id="updateCoevaluador" name="editCoevaluador" required>
                            <option value="">Seleccione un coevaluador</option>
                            <?php
                            require_once __DIR__ . "/../../modelos/conexion.php";

try {
    $conn = Conexion::conectar();
    $stmt = $conn->prepare("SELECT id_usuarios, CONCAT(nombres, ' ', apellidos) AS nombre_completo 
                            FROM usuarios WHERE ID_rol = 3 AND estado = 'Activo'");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $row) {
        echo '<option value="' . $row['id_usuarios'] . '">' . $row['nombre_completo'] . '</option>';
    }

    $stmt->closeCursor();
    $stmt = null;
} catch (PDOException $e) {
    echo '<option disabled>Error al cargar coevaluadores</option>';
}

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateEstado">Estado:</label>
                        <select class="form-control" id="updateEstado" name="editEstado" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div> 
                 <!-- Script externo para cargar departamentos y ciudades -->
                            <script src="/SAEPBETA/vistas/js/ciudades.js"></script>
                <!-- FIN modal-body -->

                <div class="modal-footer"> <!-- ✅ BOTONES DENTRO DEL FORM -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editarEmpresa">Guardar Cambios</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>


</body>
<script src="/SAEPBETA/vistas/js/empresas.js"></script>
<script src="/SAEPBETA/vistas/js/empresas_modales.js"></script>

</body>
</html>