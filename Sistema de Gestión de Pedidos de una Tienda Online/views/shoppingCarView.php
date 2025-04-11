<?php
$jsonFile = __DIR__ . '/../config/products.json';

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
    <br>
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
                <p class="h4"><strong>Total of All the Products:</strong> $<?php echo number_format($totalGeneral, 2); ?></p>
            </div>
                <div class="col-md-6">
                    <form id="buy">
                        <div class="mb-3">
                            <label for="client" class="form-label"><strong>Name of the Client:</strong></label>
                            <input type="text" id="client" name="client" class="form-control" placeholder="Enter a Name">
                            <p id="client-error"></p>
                        </div>
                            <button type="submit" class="btn btn-primary">Buy</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
        <br><br>
        <h2 class="text-center text-muted">There Are No Products Available In The Shopping Car.</h2>
    <?php endif; ?>
</body>
<script>
 $(document).ready(function () {
    $('.delete-icon').on('click', function () {
        var productId = $(this).data('id'); 
        var parentDiv = $(this).closest('.row');

        $.ajax({
            url: './config/generateJson.php',
            type: 'POST',
            data: JSON.stringify({ id: productId, action: "delete" }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function (response) {
                if (response.success) {

                    parentDiv.remove();
                    location.reload(); 
                    alert('Product Delete Succesfully');
                } else {
                    alert('couldnt Delete the Product');
                }
            },
            error: function () {
                alert('Have a Errot to Process the solicitude');
            }
        });
    });

    var client= document.getElementById('client');
    var errorClient= document.getElementById('client-error');

        $('#buy').on('submit', function (e) {
        e.preventDefault();

        var client = $('#client').val();
        var products = <?php echo json_encode($products); ?>; 

            if (client === "") {
            errorClient.textContent = "The Client cannot be empty";
            errorClient.style.color = "red";
            return; 
        }
        $.ajax({
            url: './handler/shopCarHandler.php',
            type: 'POST',
            data: JSON.stringify({ client: client, products: products, action: "insert" }),
            contentType: 'application/json; charset=utf-8',
                success: function (response) {
                console.log(response);
                location.reload();
                alert('Order Processed Successfully');
                },
                error: function () {
                alert('Have a Error to Processed the Order');
                }
            });
        });
});

</script>
</html>