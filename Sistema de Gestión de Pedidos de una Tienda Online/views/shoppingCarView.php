<?php
// Ruta del archivo JSON
$jsonFile = __DIR__ . '/../config/products.json';

// Leer y decodificar el archivo JSON
$products = [];
if (file_exists($jsonFile)) {
    $products = json_decode(file_get_contents($jsonFile), true);
}
$totalGeneral = 0;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
    <h1 class="text-center">Shopping Car</h1>
    <div class="container mt-4">
    <?php if(!empty($products)):?>
    <?php foreach($products as $data):?>
        <div class="row border border-5 rounded p-3">
            <div class="col-md-3 d-flex align-items-center">
                <img src="public/img/<?php echo $data['img'];?>" alt="Producto" class="img-fluid rounded" style="max-width: 100px;">
            </div>
            <div class="col-md-7 d-flex flex-column justify-content-center">
                <input type="text" style="display: none;" value="<?php echo $data['id'];?>">
                    <h5 id="name" class="mb-2"> <?php echo $data['name'];?></h5>
                    <p id="quantity" class="mb-1"><strong>Quantity:</strong> <?php echo $data['quantity'];?></p>
                    <p class="mb-1"><strong>Unitary Price:</strong> <?php echo $data['price'];?></p>
                    <p id="total" class="mb-1"><strong>Total:</strong> <?php echo $data['total'];?></p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <i class="bi bi-backspace-fill delete-icon" 
                    style="font-size: 80px; color: red; cursor: pointer;" 
                    data-id="<?php echo $data['id']; ?>" 
                    data-total="<?php echo $data['total']; ?>">
                </i>
            </div>
        </div>
        <br>
        <?php $totalGeneral += $data['total'];?>
    <?php endforeach;?>
        <div class="row mt-4">
            <div class="col-md-6">
                <p class="h4"><strong>Total de todos los productos:</strong> $<?php echo number_format($totalGeneral, 2); ?></p>
            </div>
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="cliente" class="form-label"><strong>Nombre del Cliente:</strong></label>
                            <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Ingrese su nombre" required>
                        </div>
                            <button type="submit" class="btn btn-primary">Procesar Pedido</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
        <br><br>
        <h2 class="text-center text-muted">No hay productos disponibles en el carrito.</h2>
    <?php endif; ?>
</body>
<script>
 $(document).ready(function () {
    $('.delete-icon').on('click', function () {
        const productId = $(this).data('id'); 
        const parentDiv = $(this).closest('.row');

        //Borrar producto
        $.ajax({
            url: './config/generateJson.php',
            type: 'POST',
            data: JSON.stringify({ id: productId, action: "delete" }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Eliminar el div
                    parentDiv.remove();
                    location.reload(); 
                    alert('Producto eliminado exitosamente');
                } else {
                    alert('No se pudo eliminar el producto');
                }
            },
            error: function () {
                alert('Hubo un error al procesar la solicitud');
            }
        });
    });
});

</script>
</html>