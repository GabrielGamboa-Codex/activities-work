<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       table.dataTable th, table.dataTable td {
            border: 1px solid orange;
            padding: 8px;
        }
        table.dataTable thead th {
        text-align: center;
        vertical-align: middle;
        }

    </style>
</head>
<body>
<br>
<h1 class="text-center">Orders</h1>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                <table id="orderTable" class="display">
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
</body>
<script>
    $(document).ready(function () {
    var userTable = $('#orderTable').DataTable({ 
        ajax: {
        url: "./handler/orderHandler.php",
        method: "POST",
        data: { action: "print" },
        dataSrc: '',
        },
        columns: [
            { data: 'cliente', title: 'Cliente' },          // Nombre del cliente
            { data: 'estado', title: 'Estado' },           // Estado del pedido
            { data: 'productos', title: 'Productos' },     // Lista de productos
            { data: 'total', title: 'Total del Pedido' }   // Total del pedido
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
