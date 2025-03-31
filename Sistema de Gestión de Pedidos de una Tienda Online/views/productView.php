<?php
    //funcion para imprimir el div
    function printDiv($name,$price,$stock,$img)
    {
        echo"
        <div class='col-md-2 me-4'>
            <div class='card d-flex flex-column align-items-center border border-5 with-image'>
                <img class='card-img-top padding-img ' src='public/img/{$img}' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>{$name}</h5>
                    <br>
                    <p class='card-text'>Precio: {$price}$</p>
                    <p class='card-text'>Stock: {$stock}</p>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#productModal'
                    data-name='{$name}' 
                    data-price='{$price}' 
                    data-stock='{$stock}' 
                    data-img='{$img}'>
                        View Details
                    </button>
                </div>
            </div>
        </div>
    ";
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
<br>
<h1 class="text-center">List of Product</h1>
<br><br>
<div class="container-fluid">
        <?php
        $count = 0;
        foreach ($products as $data) {
    
            //cuando el contador llega a un multiplo de 5 crear un nuevo row
            if ($count % 5 === 0) {
                echo "<div class='row justify-content-center'>";  
            }
            //impreme la data en base a el array de base de datos
            printDiv($data['nombre'], $data['precio'],$data['stock'],$data['id'].'.png');

            //cuando el contando llegue al 5 elemento cierra el row
            if ($count % 5 === 4) {
                echo "</div></br></br>";  
            }

            $count++; 
        }
        ?>
    </div>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row align-items-center">
                <div class="col-6">
                <img id="img" class="img-fluid rounded" alt="Product Image">
                </div>
                <div class="col-6">
                    <p id="price"></p>
                    <p id="stock"></p>
                    <label for="quantity">Quantity Of Products</label>
                    <br>
                    <input type="number" id="quantity" class="form-control" min="1" value='0'>
                    <br>
                    <p id="amount"></p>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Add to Shopping Car</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    var productModal = document.getElementById('productModal');
    productModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        //obtengo los datos de cada producto
        var name = button.getAttribute('data-name');
        var price = button.getAttribute('data-price');
        var stock = button.getAttribute('data-stock');
        var img = button.getAttribute('data-img');

        //imprimo la data en la modal
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('price').textContent = `Precio: ${price}$`;
        document.getElementById('stock').textContent = `Stock: ${stock}`;
        document.getElementById('quantity').max=`${stock}`;
        document.getElementById('img').src = `public/img/${img}`;
        document.getElementById('amount').textContent = `Total: 0$`;

        //input cantidad = MontoTotal
        var inputCantidad = document.getElementById('quantity');
        inputCantidad.addEventListener('input', function () {
            var cantidad = parseInt(inputCantidad.value) || 0; 
            var total = cantidad * parseFloat(price);
            document.getElementById('amount').textContent = `Total: ${total.toFixed(2)}$`; 
        });
    });
});
</script>
</html>
