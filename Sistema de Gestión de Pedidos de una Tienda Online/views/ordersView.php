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
                        <th>ID</th>
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
            { data: 'id' },   
            { data: 'cliente'},       
            { data: 'estado'},          
            { data: 'productos'},     
            { data: 'total'}  
        ],
        columnDefs: [
            { targets: 0, visible: false },
            { targets: 1, className: 'dt-body-center' },
            { targets: 2, className: 'dt-body-center' },
            { targets: 3, className: 'dt-body-left' },
            { targets: 4, className: 'dt-body-center' } 
        ]
    });

});
</script>
</html>
