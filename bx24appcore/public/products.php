<?php
$id = intval($_GET['id']);
$productId = intval($_POST['productId']);
$currencyId = intval($_POST['currencyId']);
$newProductName = $_POST['newProductName'];
$productNewPrice = intval($_POST['productNewPrice']);
$productUpdatePrice = intval($_POST['productUpdatePrice']);
$catalogId = intval($_POST['catalogId']);
require "../run.php";

// if ($id > 0) {
//     $resProductById = $crm->getProductById($id);
// } else { }

$resProductById = $crm->getProductById(567);

// $resProductAdd = $crm->ProductAdd(array(
//     'fields' => [
//         "NAME" => 'ApranqTest', //
//         "CURRENCY_ID" => "RUB", //$currencyId
//         "PRICE" => 4900, //$productNewPrice
//         "SORT" =>  500
//     ],
// ));

// $resProductUpdate = $crm->ProductUpdate(
//     565, //$productId
//     array(
//         "CURRENCY_ID" => "RUB",  //$currencyId
//         "PRICE" => 5000 //$productUpdatePrice
//     )
// );

// $resContactDelete = $crm->ProductDelete(565);

$resProductList = $crm->getProductList(
    array(
        'order' => ["SORT" => "ASC"],
        // 'filter' => ["CATALOG_ID" => 1], //["CATALOG_ID" => $catalogId],
        // 'select' => ["ID", "NAME", "CURRENCY_ID", "PRICE"]
    )
);

echo '<pre>';
print_r($resProductList);
