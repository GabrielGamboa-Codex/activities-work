<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       table.dataTable th, table.dataTable td {
            border: 1px solid blue;
            padding: 8px;
        }

        table.dataTable thead th {
        text-align: center;
        vertical-align: middle;
        }
        
        table.dataTable tbody tr:hover {
        background-color:rgb(204, 207, 216); /* Cambia el color de fondo */
        cursor: pointer; /* Cambia el cursor a una mano */
        }

    </style>
</head>
<body>
<br>
<h1 class="text-center">Administration</h1>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                <table id="adminTable" class="display">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Productos</th>
                        <th>Total del Pedido</th>
                        </tr>
                    </thead>
                </table>
                <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>

<div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <label for="estatus">New Status</label>
                    <select name="estatus" id="estatus" class="form-select">
                        <option value="">Select</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="procesado">Procesado</option>
                        <option value="enviado">Enviado</option>
                        <option value="entregado">Entregado</option>
                    </select>
                    <p id="errorSelect"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-warning" id="editar">Save Edit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
</body>
<script>
    $(document).ready(function () {
        var adminTable = $('#adminTable').DataTable({ 
        ajax: {
        url: "./handler/orderHandler.php",
        method: "POST",
        data: { action: "print" },
        dataSrc: '',
        },
        columns: [
            { data: 'id' },
            { data: 'cliente' },        
            { data: 'estado'},                    
            { data: 'productos'},   
            { data: 'total'}   
        ],
        columnDefs: [
            { targets: 0, visible: false },
            { targets: 1, className: 'dt-body-center' },
            { targets: 2, className: 'dt-body-center' },
            { targets: 3, className: 'dt-left-center' },
            { targets: 4, className: 'dt-body-center' } 
        ]
    });

    var data;

    $('#adminTable tbody').on('click', 'tr', function () {
        data = adminTable.row(this).data();
        $('#editModal').modal('show'); 
    });
    
    $('#estatus').select2({
        dropdownParent: $('#editModal'),
        width: '80%'
    });

    $('#editar').on('click', function (e) {
        e.preventDefault();
        var id = data.id;
        var estatus = $('#estatus').val();
        var errorSelect= document.getElementById('errorSelect');

        if (estatus === "") {
            errorSelect.textContent = "The Select cannot be empty, Choose a Option";
            errorSelect.style.color = "red";
            return; 
        }

        var editData = {
            id: id,
            estatus: estatus,
            action: 'edit'
        }

        $.ajax({
            url: './handler/adminHandler.php',
            type: 'POST',
            data: editData,
                success: function (response) {
                console.log(response);
                adminTable.ajax.reload();
                $('#editModal').modal('hide');
                $('#estatus').val('').trigger('change');  
                alert('Se ha Editado Correctamente.');
                },
                error: function () {
                alert('Hubo un error al procesar al Editar.');
                }
            });
        });

});

</script>
</html>