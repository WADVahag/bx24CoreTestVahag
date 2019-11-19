<?php
$id = intval($_GET['id']);
// $contactId = $_POST['contactId'];
// $newContactName = $_POST['newContactName'];
// $newContactSecondName = $_POST['newContactSecondName'];
// $newContactCompanyId = $_POST['newContactCompanyId'];
// $newContactPhone = $_POST['newContactPhone'];

require "../run.php";

// $resContacts = $crm->getContacts();

// if ($id > 0) {
//     $resContactById = $crm->getContactById($id);
// } else {
//     $resContacts = $crm->getContactList();
// }


$resContacts = $crm->getContactList(array(
    'order' => ["ID" => "DESC"],
    // 'filter' => [">PROBABILITY"=> 50 ], //["CATALOG_ID" => $catalogId],
    'select' => ["*", "UF_*"]
));



// $resContactAdd = $crm->ContactAdd(array(
//     'fields' => [
//         "NAME" => 'Valod', //$newContactName,
//         "LAST_NAME" => 'Valodyan', //$newContactSecondName,
//         "ASSIGNED_BY_ID" => 1,
//         "PHONE" =>  array(["VALUE" => '123456', "VALUE_TYPE" => "WORK"]) //array(["VALUE" => $newContactPhone, "VALUE_TYPE" => "WORK"])
//     ],
//     'params' => ['REGISTER_SONET_EVENT' => 'Y']

// ));
// $resContactUpdate = $crm->ContactUpdate(
//     7, //$contactId
//     array(
//         "NAME" => 'kukuZavr', //$newContactName,
//         "LAST_NAME" => 'Valodyanc', //$newContactSecondName,
//         "ASSIGNED_BY_ID" => 1,
//         "PHONE" =>  array(["VALUE" => '1234567', "VALUE_TYPE" => "WORK"]) //array(["VALUE" => $newContactPhone, "VALUE_TYPE" => "WORK"])
//     )
// );

$resAttachContactToCompany = $crm->AttachContactToCompany($contactId, $companyId);

// $resContactDelete = $crm->ContactDelete(5);

echo '<pre>';
print_r($resContacts);
