<?php

$id = intval($_GET['id']);

// $contactId = $_POST['contactId'];
// $companieId = $_POST['companieId'];
// $title = $_POST['title'];
// $currencyId = $_POST['currencyId'];
// $price = $_POST['price'];
// $dateStart = $_POST['dateStart'];
// $dateEnd = $_POST['dateEnd'];

require "../run.php";





$date = date('Y-m-d H:i:s');
$datetime = new DateTime('tomorrow');
$tommorow = $datetime->format('Y-m-d H:i:s');
// $resDealGet = $crm->getDealById($id);

// $resDeals = $crm->getDealList(array(
//     'order' => ["ID" => "DESC"],
//     // 'filter' => [">PROBABILITY"=> 50 ], //["CATALOG_ID" => $catalogId],
//     'select' => ["*", "UF_*"]
// ));

// $resDealAdd = $crm->DealAdd(array(
//     'fields' => array(
//         "TITLE" => "Плановая продажа", //$title,
//         "TYPE_ID" => "GOODS",
//         "STAGE_ID" => "NEW",
//         "COMPANY_ID" => 5, //$companieId,
//         "CONTACT_ID" => 7, //$contactId,
//         "OPENED" => "Y",
//         "ASSIGNED_BY_ID" => 1,
//         "PROBABILITY" => 30,
//         "CURRENCY_ID" => "USD", //$currencyId,
//         "OPPORTUNITY" => 5000, //$price,
//         "BEGINDATE" => strtotime($date), //$dateStart,
//         "CLOSEDATE" => strtotime($tommorow) //$dateEnd
//     ),
//     'params' => array("REGISTER_SONET_EVENT" => "Y")

// ));
// $resDealUpdate = $crm->DealUpdate(
//     7,
//     array(
//         "TITLE" => "Плановая продажа252",
//         "TYPE_ID" => "GOODS",
//         "STAGE_ID" => "NEW",
//         "COMPANY_ID" => 5, //$companieId
//         "CONTACT_ID" => 7, //$contactId
//         "OPENED" => "Y",
//         "ASSIGNED_BY_ID" => 1,
//         "PROBABILITY" => 30,
//         "CURRENCY_ID" => "USD",
//         "OPPORTUNITY" => 5000,
//         "BEGINDATE" => strtotime($date),
//         "CLOSEDATE" => strtotime($tommorow)
//     )
// );
// $resDealDelete = $crm->DealDelete(7);

$resDealContactAdd = $crm->DealContactAdd($dealId, $contactId); //(9, 13); 

echo '<pre>';
print_r($resDealContactAdd);
