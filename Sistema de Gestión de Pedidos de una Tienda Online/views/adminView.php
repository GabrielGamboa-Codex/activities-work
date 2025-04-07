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

        table.dataTable tbody tr {
            cursor: pointer;
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

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-warning"><i class="bi bi-pencil-square">Edit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
<script>
    $(document).ready(function () {
    var userTable = $('#adminTable').DataTable({ 
        ajax: {
        url: "./handler/orderHandler.php",
        method: "POST",
        data: { action: "print" },
        dataSrc: '',
        },
        columns: [
            { data: 'cliente' },        
            { data: 'estado'},                    
            { data: 'productos'},   
            { data: 'total'}   
        ],
        columnDefs: [
            { targets: 0, className: 'dt-body-center' },
            { targets: 1, className: 'dt-body-center' },
            { targets: 2, className: 'dt-body-left' },
            { targets: 3, className: 'dt-body-center' } 
        ]
    });

});
</script>
</html>