<?php
require_once __DIR__ . '/../models/productModel.php';
        $teamModel = new TeamModel();
        $products = $teamModel->dataProduct();
    function printDivModal($name,$price,$espacio,$img,$modalId,$contenido =" ",$idJs)
    {
        $espacio = ($espacio === "1") ? "ms-3" : "";
        echo"
        <div class='card d-flex flex-column align-items-center border border-5 with-image {$espacio}'>
            <img class='card-img-top padding-img ' src='public/img/{$img}' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>{$name}</h5>
                    <p class='card-text'>Precio: {$price}</p>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#{$modalId}'>
                        View Details
                    </button>
            </div>
        </div>
        <div class='modal fade modal-lg' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='{$modalId}Label'>$name</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                        <div class='modal-body d-flex justify-content-end align-items-start'>
                            <div>
                                {$contenido}
                                </br></br></br></br></br>
                                <p>Stock:</p>
                                <p class='card-text'>Precio: {$price}</p>
                                <div class='d-flex align-items-center'>
                                    <p class='me-2 mb-0'>Cantidad:</p>
                                    <div class='input-group input-group-sm' style='width: 80px;'>
                                        <input type='number' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm'>
                                    </div>
                                </div>
                                <br>
                                <p class='card-text'>Total:</p>
                                </br></br>
                            </div>
                            <img class='img-fluid' src='public/img/{$img}' style='width: 300px; height: auto;' alt='Imagen del modal'>
                        </div>
                    <div class='modal-footer justify-content-center'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' id='{$idJs}' class='btn btn-success'>Add to Shopping Car</button>
                    </div>
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
<div class="row justify-content-center">
    <?php
        printDivModal("Dorito 250gm",'7,5$',"0","doritos.webp",'doritosModal','Comida de Quezo empanizada referente a los estados unidos bien con el empaque','doritoJs');
        printDivModal("Camisa Masculina",'35$',"1","camisa.avif",'camisaModal','Camisa de Lana 60% y 40% de Algodon talla L y XL, Masculino Original de la Marca MaxMen','camisaJs');
        printDivModal('Chaleco de Invierno','125,39$',"1","chaleco.jpg",'chalecoModal','Chaleco invernal para epocas de Frio 90% de algodon, 10% pelo de cabra de la Marca Sinfrinas','chalecoJs');
        printDivModal('Zapatos Masculinos Gala','42.04$',"1","zapato.png",'zapatosModal','Zapatos hechos de cuero de cocodrilo y serpiente amazaonicas 100% Original','zapatoJs');
        printDivModal('Blusa Fushia','77$',"1","ropa-mujer.jpg",'blusaModal','Blusa hecha de Polietileno Adaptable al Frio original de la Marca Franshies','blusaJs');
    ?>
</div>
<br><br><br>
<div class="row justify-content-center">
    <?php
        printDivModal("Tacones Punta Fina",'56,70$',"0","tacones.jpeg",'taconesModal','Tacones de punta Fina, de tacon de cuero de la marca Aqua color Rosado talla 40','taconesJs');
        printDivModal('Mesa de Madera Roble','111$',"1","mesa.jpg",'mesaModal','Mesa de madera de roble de 35cm de alto y 50 cm de largo, hecha 100% madera de roble','mesaJs');
        printDivModal('Dragon Slayer Berseker','150',"1","dragon-slayer.webp",'dragonslModal','Replica de 1,65 cm de largo de la espada de Guns de Berkerk hecho de 100% plastico solidificado','espadaJs');
        printDivModal('Alma del Lord del Fuego','999.99$',"1","alma-de-los-senores.jpg",'almaModal','Alma de los Lords del fuego nacidos de la Flama primigenia obtorgando el poder de Arremter contra el Fin','almaJs');
        printDivModal('Blue Jeans','52.07$',"1","pantalones.png",'pantalonesModal','Pantalones originales de la Marca Blue Jean originales tall L y XL','pantalonesJs');
    ?>
</div>
<br><br>
</body>
</html>
<?php

?>