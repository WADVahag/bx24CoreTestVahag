<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products </title>
</head>
<style>

.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  left:47vw;
  top:15vw;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
 background-color: #25af36;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.loading{
    color: #25af36;
    position:relative;
   
    top:13vw;
    text-align: center;
}
</style>
<body>
    <h1 class='loading'> Սինխրոնիզացում</h1>
<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</body>
</html>

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
    if (!empty($materialsChunk)) {
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

            // if ($i == 55) {
            //     die;
            // }

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

                // echo '<pre>';
                // print_r($resProductAdd);
                // echo '<br> Avelacvel e nor produkt' . 'productXMLID === ' . $productXMLID . 'productUpdateId === ' . $productUpdateId . 'MATERIAL KOD HC ====' . $material['Code'];
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

                // echo '<pre>';
                // print_r($resProductUpdate);
                // echo '<br> Haytnabervela Hamnknum katarvel a Tarmacum' . $productXMLID . 'productUpdateId === ' . $productUpdateId . 'MATERIAL KOD HC ====' . $material['Code'];
            }
        }
    }   else{
        echo 'materialsChunk is empty';
    break;
    }
}


?>
