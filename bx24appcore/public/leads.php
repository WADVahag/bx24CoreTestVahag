<?php

$id = intval($_GET['id']);

// $contactId = $_POST['contactId'];
// $companieId = $_POST['companieId'];
// $title = $_POST['title'];
// $name = $_POST['name'];
// $secondName = $_POST['secondName'];
// $lastName = $_POST['lastName'];
// $currencyId = $_POST['currencyId'];
// $price = $_POST['price'];
// $phoneNumber = $_POST['phoneNumber'];
require "../run.php";

$getLeads = $crm->getLeadList(array(
    'order' => ["ID" => "DESC"],
    // 'filter' => [">PROBABILITY"=> 50 ], //["CATALOG_ID" => $catalogId],
    'select' => ["*", "UF_*"]
));


// $resLeadAdd = $crm->LeadAdd(array(
//     'fields' => array(

//         "TITLE" => "ИП Титов", //$title, 
//         "NAME" => "Глеб",  //$name,
//         "SECOND_NAME" => "Егорович", //$secondName 
//         "LAST_NAME" => "Титов", //$lastName,
//         "STATUS_ID" => "NEW",
//         "OPENED" => "Y",
//         "ASSIGNED_BY_ID" => 1,
//         "CURRENCY_ID" => "USD", //$currencyId,
//         "OPPORTUNITY" => 12500, //$price,
//         "PHONE" => array("VALUE" => '555888', "VALUE_TYPE" => "WORK") // array("VALUE" => $phoneNumber, "VALUE_TYPE" => "WORK")
//     ),
//     'params' => array("REGISTER_SONET_EVENT" => "Y")


// ));

// $resLeadUpdate = $crm->LeadUpdate(
//     3, //$id
//     array(

//         "TITLE" => "ИП Титов 2222", //$title, 
//         "NAME" => "Глеб",  //$name,
//         "SECOND_NAME" => "Егорович", //$secondName 
//         "LAST_NAME" => "Титов", //$lastName,
//         "STATUS_ID" => "NEW",
//         "OPENED" => "Y",
//         "ASSIGNED_BY_ID" => 1,
//         "CURRENCY_ID" => "USD", //$currencyId,
//         "OPPORTUNITY" => 12500, //$price,
//         "PHONE" => array("VALUE" => '555888', "VALUE_TYPE" => "WORK") // array("VALUE" => $phoneNumber, "VALUE_TYPE" => "WORK")
//     )
// );

// $resLeadDelete =  $crm->LeadDelete(3); //$crm->LeadDelete($id);
echo '<pre>';
print_r($getLeads);
