<?php
    //funcion para imprimir el div
    function printDiv($id,$name,$price,$stock,$img)
    {
        echo"
        <div class='col-md-2 me-4'>
            <div class='card d-flex flex-column align-items-center border border-5 with-image'>
                <img class='card-img-top padding-img ' src='public/img/{$img}' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title mb-1'>{$name}</h5>
                    <br>
                    <p class='card-text mb-1'>Precio: {$price}$</p>
                    <p class='card-text mb-1'>Stock: {$stock}</p>
                    <br>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#productModal'
                     data-id='{$id}'
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
            printDiv($data['id'],$data['nombre'], $data['precio'],$data['stock'],$data['id'].'.png');

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
                    <div id="id" class="mb-1"></div>
                    <p id="price" class="mb-1"></p>
                    <p id="stock" class="mb-1"></p>
                    <label for="quantity">Quantity Of Products</label>
                    <br>
                    <input type="number" id="quantity" class="form-control mb-2" min="1" value='0'>
                    <p id="error_quantity"></p>
                    <p id="amount" class="mb-1"></p>
                </div>
            </div>
        </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success">Add to Shopping Car</button>
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

        // Obtengo los data
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var price = button.getAttribute('data-price');
        var stock = button.getAttribute('data-stock');
        var img = button.getAttribute('data-img');

        // Imprimo la data en la modal
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('price').textContent = `Precio: ${price}$`;
        document.getElementById('stock').textContent = `Stock: ${stock}`;
        document.getElementById('quantity').max = `${stock}`;
        document.getElementById('img').src = `public/img/${img}`;
        document.getElementById('amount').textContent = `Total: 0$`;

        
        var inputCantidad = document.getElementById('quantity');
        inputCantidad.addEventListener('input', function () {
            var cantidad = parseInt(inputCantidad.value) || 0; 
            var total = cantidad * parseFloat(price);
            document.getElementById('amount').textContent = `Total: ${total.toFixed(2)}$`; 
        });

        //evento del boton a#adir
        var addToCart = productModal.querySelector('.btn-success');
        addToCart.onclick = function (event) {
            event.preventDefault(); 

            var quantity = parseInt(document.getElementById('quantity').value) || 0;
            var errorQuantity = document.getElementById('error_quantity');

            if (quantity > 0) {
                errorQuantity.textContent = "";

                // objeto JSON con los datos del producto
                var productData = {
                    id: id,
                    name: name,
                    price: price,
                    quantity: quantity,
                    total: (quantity * parseFloat(price)).toFixed(2),
                    img: img,
                    action: "generate"
                };

                $.ajax({
                     url: './config/generateJson.php',
                     type: 'POST', 
                     contentType: 'application/json', 
                     data: JSON.stringify(productData),
                     success: function(response) {
                        console.log('Producto guardado correctamente:', response);
                        document.getElementById('quantity').value = `0`;
                        alert('Producto añadido al carrito');
                     },
                     error: function(error) {
                        console.error('Error al guardar el producto:', error);
                     }
                });

                var modal = bootstrap.Modal.getInstance(productModal); 
                modal.hide(); 
            } else {
                //en caso de ser 0 mostrar un error
                errorQuantity.textContent = " must be greater than 0.";
                errorQuantity.style.color = "red";
            }
        };
    });
});

</script>
</html>
