<?php

require "../bx24appcore/run.php";

$aHTTP['http']['header'] = "User-Agent: PHP-SOAP/5.5.11\r\n";
$context = stream_context_create($aHTTP);
$client = new SoapClient($armsoft->soapUrl, array('trace' => 1, "stream_context" => $context));
$materials = $armsoft->getProducts($client);
$materialsAll = json_decode(json_encode($materials), true);

file_put_contents('allMaterials.json', json_encode($materialsAll, JSON_UNESCAPED_UNICODE));

$resProductList = $crm->getProductList(
    array(
        'order' => ["SORT" => "ASC"],
        // 'filter' => ["CATALOG_ID" => 1], //["CATALOG_ID" => $catalogId],
        // 'select' => ["ID", "NAME", "CURRENCY_ID", "PRICE"]
    )
);

echo '<pre>';

$i = 0;
foreach ($materialsAll as $keychunk => $materialsChunk) {
    if ($materialsChunk !== []) {
        foreach ($materialsChunk as $keyMaterial => $material) {

            $resProduct = $crm->getProductList(
                array(
                    'order' => ["SORT" => "ASC"],
                    'filter' => ["XML_ID" => $material['Code']], //["CATALOG_ID" => $catalogId],
                    // 'select' => ["ID", "NAME", "CURRENCY_ID", "PRICE"]
                )
            );

            $productUpdateId = $resProduct['result'][0]['ID'];
            $productXMLID = $resProduct['result'][0]['XML_ID'];

            $i++;

            if ($i == 5) {
                die;
            }
            if ($productXMLID != $material['Code']) {

                sleep(1);
                $resProductAdd = $crm->ProductAdd(array(
                    'fields' => [
                        "NAME" => $material['Name'], //
                        "CURRENCY_ID" => "RUB", //$currencyId
                        "PRICE" => $material['RetailPrice'], //$productNewPrice
                        "DETAIL_TEXT" => $material['Description'], //$productUpdatePrice
                        "PREVIEW_TEXT" => $material['Description'], //$productUpdatePrice
                        "SORT" =>  500,
                        "XML_ID" => $material['Code']
                    ],
                ));
                echo '<pre>';
                print_r($resProductAdd);
                echo '<br> Avelacvel e nor produkt' . 'productXMLID === ' . $productXMLID . 'productUpdateId === ' . $productUpdateId . 'MATERIAL KOD HC ====' . $material['Code'];
            } else {
                sleep(1);
                $resProductUpdate = $crm->ProductUpdate(
                    $productUpdateId, //id of updated product
                    array(
                        "NAME" => $material['Name'],
                        "PRICE" => $material['RetailPrice'], //$productUpdatePrice
                        "DETAIL_TEXT" => $material['Description'], //$productUpdatePrice
                        "PREVIEW_TEXT" => $material['Description'], //$productUpdatePrice
                    )
                );

                echo '<pre>';
                print_r($resProductUpdate);
                echo '<br> Haytnabervela Hmanknum katarvel a Tarmacum' . $productXMLID . 'productUpdateId === ' . $productUpdateId . 'MATERIAL KOD HC ====' . $material['Code'];
            }
        }
    }
}
