<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empresas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .selected { background: #d4edda !important; }
        .btn-group { margin-top: 15px; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h3>Empresas</h3>
    <table class="table table-bordered" id="empresaTable">
        <thead class="thead-light">
            <tr>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Coevaluador</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
<?php
$conn = new mysqli("localhost", "root", "", "saep");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT e.ID_usuarios, e.nit, e.nombre_empresa, e.contacto, e.email, 
               e.direccion, e.departamento, e.ciudad, e.area, e.estado,
               CONCAT(u.nombres, ' ', u.apellidos) AS coevaluador
        FROM empresas e
        LEFT JOIN usuarios u ON e.ID_usuarios = u.ID_usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  echo "<tr onclick=\"selectRow(this)\" 
        data-idusuario='{$row['ID_usuarios']}'
        data-nit='{$row['nit']}'
        data-nombre='{$row['nombre_empresa']}'
        data-direccion='{$row['direccion']}'
        data-area='{$row['area']}'
        data-contacto='{$row['contacto']}'
        data-email='{$row['email']}'
        data-departamento='{$row['departamento']}'
        data-ciudad='{$row['ciudad']}'
        data-coevaluador='{$row['coevaluador']}'
        data-estado='{$row['estado']}'>
    <td>{$row['nit']}</td>
    <td>{$row['nombre_empresa']}</td>
    <td>{$row['contacto']}</td>
    <td>{$row['coevaluador']}</td>
    <td>{$row['estado']}</td>
</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No hay empresas registradas.</td></tr>";
}
$conn->close();
?>
</tbody>
                </table>
                <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <button class="btn btn-info" data-toggle="modal" data-target="#detalleModal">Detalles</button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#actualizarModal">Actualizar</button>
                    <button class="btn btn-success" onclick="generarPDF()">Generar PDF</button>
                </div>
                </div>
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
            <div class="modal-body">
                <form id="formActualizar">
                    <div class="form-group">
                        <label for="updateNit">NIT:</label>
                        <input type="text" class="form-control" id="updateNit" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updateNombre">Nombre:</label>
                        <input type="text" class="form-control" id="updateNombre" required>
                    </div>
                    <div class="form-group">
                        <label for="updateTelefono">Teléfono:</label>
                        <input type="text" class="form-control" id="updateTelefono" required>
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email:</label>
                        <input type="email" class="form-control" id="updateEmail">
                    </div>
                    <div class="form-group">
                        <label for="updateDireccion">Dirección:</label>
                        <input type="text" class="form-control" id="updateDireccion">
                    </div>
                    <div class="form-group">
                        <label for="updateDepartamento">Departamento:</label>
                        <input type="text" class="form-control" id="updateDepartamento">
                    </div>
                    <div class="form-group">
                        <label for="updateCiudad">Ciudad:</label>
                        <input type="text" class="form-control" id="updateCiudad">
                    </div>
                    <div class="form-group">
                        <label for="updateArea">Área:</label>
                        <input type="text" class="form-control" id="updateArea">
                    </div>
                    <div class="form-group">
                        <label for="updateCoevaluador">Coevaluador:</label>
                        <select class="form-control" id="updateCoevaluador" name="coevaluador" required>
                            <option value="">Seleccione un coevaluador</option>
                            <?php
                            $conn = new mysqli("localhost", "root", "", "saep");
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }
                            $sql = "SELECT ID_usuarios, CONCAT(nombres, ' ', apellidos) AS nombre_completo 
                                    FROM usuarios WHERE ID_rol = 3 AND estado = 'Activo'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['ID_usuarios'].'">'.$row['nombre_completo'].'</option>';
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateEstado">Estado:</label>
                        <select class="form-control" id="updateEstado" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script>
let selectedRow = null;

function selectRow(row) {
    if (selectedRow) selectedRow.classList.remove('selected');
    selectedRow = row;
    row.classList.add('selected');

    $('#modalIDUsuario').text(row.dataset.idusuario);
    $('#modalNit').text(row.dataset.nit);
    $('#modalNombre').text(row.dataset.nombre);
    $('#modalDireccion').text(row.dataset.direccion);
    $('#modalArea').text(row.dataset.area);
    $('#modalTelefono').text(row.dataset.contacto);
    $('#modalEmail').text(row.dataset.email);
    $('#modalDepartamento').text(row.dataset.departamento);
    $('#modalCiudad').text(row.dataset.ciudad);
    $('#modalCoevaluador').text(row.dataset.coevaluador);
    $('#modalEstado').text(row.dataset.estado);
}

$('#actualizarModal').on('show.bs.modal', function () {
    if (!selectedRow) {
        alert('Seleccione una empresa');
        return false;
    }

    $('#updateNit').val(selectedRow.dataset.nit);
    $('#updateNombre').val(selectedRow.dataset.nombre);
    $('#updateTelefono').val(selectedRow.dataset.contacto);
    $('#updateEmail').val(selectedRow.dataset.email);
    $('#updateDireccion').val(selectedRow.dataset.direccion);
    $('#updateDepartamento').val(selectedRow.dataset.departamento);
    $('#updateCiudad').val(selectedRow.dataset.ciudad);
    $('#updateArea').val(selectedRow.dataset.area);
    $('#updateCoevaluador').val(selectedRow.dataset.idusuario); // OJO: usar ID aquí
    $('#updateEstado').val(selectedRow.dataset.estado);
});

function guardarCambios() {
    if (!selectedRow) return;
    const cells = selectedRow.getElementsByTagName('td');
    cells[1].textContent = $('#updateNombre').val();
    cells[2].textContent = $('#updateTelefono').val();
    cells[3].textContent = $('#updateCoevaluador').val();
    cells[4].textContent = $('#updateEstado').val();
    $('#actualizarModal').modal('hide');
}

function generarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text('Reporte de Empresas', 105, 15, { align: 'center' });
    const table = document.getElementById('empresaTable');
    const rows = table.querySelectorAll('tbody tr');
    const tableData = [];
    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        tableData.push([
            cells[0].textContent,
            cells[1].textContent,
            cells[2].textContent,
            cells[3].textContent,
            cells[4].textContent
        ]);
    });
    doc.autoTable({
        head: [['NIT', 'Nombre', 'Teléfono', 'Coevaluador', 'Estado']],
        body: tableData,
        startY: 25
    });
    doc.save('reporte_empresas.pdf');
}

window.onload = function() {
    const firstRow = document.querySelector('tbody tr');
    if (firstRow) selectRow(firstRow);
};
</script>
</body>
</html>
