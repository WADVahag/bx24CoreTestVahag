<?php


require "../bx24appcore/run.php";

$aHTTP['http']['header'] = "User-Agent: PHP-SOAP/5.5.11\r\n";
$context = stream_context_create($aHTTP);
$client = new SoapClient($armsoft->soapUrl, array('trace' => 1, "stream_context" => $context));
$materials = $armsoft->getProducts($client);
$materialsAll = json_decode(json_encode($materials), true);
$i = 0;

// file_put_contents('allMaterials.json', json_encode($materialsAll, JSON_UNESCAPED_UNICODE));

foreach ($materialsAll as $keychunk => $materialsChunk) {
    // if (!empty($materialsChunk)) {
        foreach ($materialsChunk as $keyMaterial => $material) {

            $resProduct = $crm->getProductList(
                array(
                    'order' => ["SORT" => "ASC"],
                    'filter' => ["XML_ID" => $material['Code']], //["CATALOG_ID" => $catalogId],
                    // 'select' => ["ID", "NAME", "CURRENCY_ID", "PRICE"]
                )
            );

            $resProduct = json_decode($resProduct , true);

            $productUpdateId = $resProduct['result'][0]['ID'];
            $productXMLID = $resProduct['result'][0]['XML_ID'];

            $i++;

            if ($i > $materialsAll['totalProducts']) {
                echo "we have CHanged ".($i - 1);
                echo " Products";
                die;
            }

            if ($productXMLID != $material['Code']) {
                sleep(1);
                $resProductAdd = $crm->ProductAdd(array(
                    'fields' => [
                        "NAME" => $material['Name'], //
                        "CURRENCY_ID" => "AMD", //$currencyId
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
                        "CURRENCY_ID" => "AMD", //$currencyId
                        "PRICE" => $material['RetailPrice'], //$productUpdatePrice
                        "DETAIL_TEXT" => $material['Description'], //$productUpdatePrice
                        "PREVIEW_TEXT" => $material['Description'], //$productUpdatePrice
                    )
                );

                echo '<pre>';
                print_r($resProductUpdate);
                echo '<br> Haytnabervela Hamnknum katarvel a Tarmacum' . $productXMLID . 'productUpdateId === ' . $productUpdateId . 'MATERIAL KOD HC ====' . $material['Code'];
            }
        }
}


?>
